<?php

namespace App\Exports;

use App\Models\Contrato;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContractsExport implements FromCollection, WithHeadings, WithMapping
{
    protected $status;

    /**
     * Constructor para recibir el filtro de estado.
     *
     * @param string|null $status
     */
    public function __construct($status = null)
    {
        $this->status = $status;
    }

    /**
     * Obtener la colección de datos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $query = Contrato::with(['cliente', 'propiedad']);
        if ($this->status) {
            $query->where('status', $this->status);
        }
        return $query->get();
    }

    /**
     * Definir los encabezados del archivo Excel.
     *
     * @return array
     */
    public function headings(): array
    {
        return [
            'ID',
            'Cliente',
            'Propiedad',
            'Tipo',
            'Monto',
            'Estado',
            'Fecha Inicio',
            'Fecha Fin',
        ];
    }

    /**
     * Mapear los datos de cada fila.
     *
     * @param \App\Models\Contrato $contrato
     * @return array
     */
    public function map($contrato): array
    {
        return [
            $contrato->contract_id,
            $contrato->cliente->nombre_completo ?? 'N/A',
            ($contrato->propiedad->address ?? 'N/A') . ', ' . ($contrato->propiedad->city ?? 'N/A'),
            $contrato->contract_type,
            $contrato->amount,
            $contrato->status,
            $contrato->start_date,
            $contrato->end_date,
        ];
    }
}