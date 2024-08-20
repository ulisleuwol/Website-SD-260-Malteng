<?php

namespace App\DataTables;

use App\Models\Guru;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class GuruDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable($query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('checkbox', function ($data) {
                return '<input type="checkbox" class="bulk-checkbox" value="' . $data->slug . '">';
            })
            ->addColumn('foto', function ($data) {
                if ($data->image) {
                    $url = asset('storage/guru-images/' . $data->image);
                    return '<img src="' . $url . '" alt="Foto" class="img-thumbnail" width="50" loading="lazy" />';
                } else {
                    return 'Tidak ada gambar';
                }
            })
            ->addColumn('aksi', function ($data) {
                return sprintf(
                    '<a href="%s" class="btn btn-sm btn-success" title="Lihat">
                        <i class="bi bi-eye"></i>
                    </a>

                    <button class="btn btn-sm btn-warning" onclick="confirmEdit(this)" data-slug="%s" title="Edit">
                    <i class="bi bi-pencil-square"></i>
                    </button>

                    <button class="btn btn-sm btn-danger" onclick="confirmDelete(this)" data-slug="%s" title="Hapus">
                    <i class="bi bi-trash"></i>
                </button>
                    <form id="delete-form-%d" method="POST" aksi="%s" style="display: none;">
                        %s
                        %s
                    </form>',
                    route('guru.show', $data->slug),
                    $data->slug, // slug attribute for edit button
                    $data->slug, // slug attribute for delete button
                    $data->id,
                    route('guru.edit', $data->slug),
                    // route('guru.destroy', $data->slug),
                    method_field('DELETE'),
                    csrf_field()
                );
            })
            ->rawColumns(['checkbox', 'foto', 'aksi'])
            ->addIndexColumn()
            ->setRowId('id');
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Guru $model)
    {
        return $model->newQuery()->where('user_id', auth()->user()->id)->latest();
    }
    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
            ->setTableId('data-table')
            ->columns($this->getColumns())
            ->minifiedAjax()
            ->orderBy(1)
            ->selectStyleSingle()
            ->parameters([
                'responsive' => true,
                'lengthMenu' => [
                    [5, 10, 25, 50, 100],
                    [5, 10, 25, 50, 100],
                ],
                'dom' => "<'row pb-2 mb-0'<'col-md-3'l><'col-md-5'B><'col-md-4'f>>" .
                    "<'row pt-0 mt-0'<'col-md-8'Q>tr>>" .
                    "<'row '<'col-12'tr>>" .
                    "<'row '<'col-md-5 pt-2'i><'col-md-7 pt-3 d-flex justify-content-end overflow-x-auto'p>>",
                'buttons' => ['selectAll', 'selectNone'],
            ]);
    }

    /**
     * Get the dataTable columns definition.
     */
    public function getColumns(): array
    {
        return [
            Column::computed('checkbox')
                ->title('<input type="checkbox" id="select-all">')
                ->orderable(false)
                ->searchable(false)
                ->width(10)
                ->addClass('text-center')
                ->render(function ($data) {
                    // Jika $data adalah objek guru dan memiliki properti 'id'
                    if ($data instanceof \App\Models\Guru && property_exists($data, 'id')) {
                        return '<input type="checkbox" class="bulk-checkbox" value="' . $data->id . '">';
                    }
                    // Jika $data adalah array dan memiliki kunci 'id'
                    elseif (is_array($data) && array_key_exists('id', $data)) {
                        return '<input type="checkbox" class="bulk-checkbox" value="' . $data['id'] . '">';
                    }
                    // Jika tidak ada 'id' dalam data, atau jika tipe datanya tidak dikenali
                    else {
                        return '';
                    }
                }),
            Column::make('nama')->title('Nama'),
            Column::make('jabatan')->title('Jenis PTK'),
            Column::make('foto')->title('Foto'),
            Column::computed('aksi')
                ->exportable(false)
                ->printable(false)
                ->width(120)
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Guru_' . date('YmdHis');
    }
}
