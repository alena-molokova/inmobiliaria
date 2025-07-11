<?php

namespace App\Exports;

use App\Models\Propiedad;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class PropertiesExport implements FromCollection, WithHeadings, WithMapping
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
        $query = Propiedad::with('empleado');
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
            'Dirección',
            'Ciudad',
            'Tipo',
            'Precio',
            'Estado',
            'Responsable',
        ];
    }

    /**
     * Mapear los datos de cada fila.
     *
     * @param \App\Models\Propiedad $propiedad
     * @return array
     */
    public function map($propiedad): array
    {
        return [
            $propiedad->property_id,
            $propiedad->address,
            $propiedad->city,
            $propiedad->property_type,
            $propiedad->price,
            $propiedad->status,
            $propiedad->empleado->first_name . ' ' . $propiedad->empleado->last_name ?? 'N/A',
        ];
    }
}