<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\RamadhanRequest;
use App\Models\Lot;
use App\Models\Ramadhan;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class RamadhanCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class RamadhanCrudController extends CrudController
{
    use \Backpack\CRUD\app\Http\Controllers\Operations\ListOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\CreateOperation {
        store as traitStore;
    }
    use \Backpack\CRUD\app\Http\Controllers\Operations\UpdateOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\DeleteOperation;
    use \Backpack\CRUD\app\Http\Controllers\Operations\ShowOperation;

    /**
     * Configure the CrudPanel object. Apply settings to all operations.
     * 
     * @return void
     */
    public function setup()
    {
        CRUD::setModel(\App\Models\Ramadhan::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/ramadhan');
        CRUD::setEntityNameStrings('ramadhan', 'ramadhan');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        if (auth()->user()->hasRole('Admin')) {
            $this->crud->query->where('masjid_id', auth()->user()->masjids->masjid->id);
        }

        CRUD::column('id');
        CRUD::column('masjid_id');
        CRUD::column('tahun');
        CRUD::column('created_at');
        CRUD::column('updated_at');

        /**
         * Columns can be defined using the fluent syntax or array syntax:
         * - CRUD::column('price')->type('number');
         * - CRUD::addColumn(['name' => 'price', 'type' => 'number']); 
         */
    }

    /**
     * Define what happens when the Create operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-create
     * @return void
     */
    protected function setupCreateOperation()
    {
        CRUD::setValidation(RamadhanRequest::class);

        CRUD::field('masjid_id')->default(auth()->user()->masjids->masjid->id);
        CRUD::field('tahun');


        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    protected function store()
    {
        $ramadhan = Ramadhan::create([
            'masjid_id' => request()->masjid_id,
            'tahun' => request()->tahun,
        ]);
        // dd($ramadhan, request()->all());
        if ($ramadhan) {
            for ($i = 1; $i < 31; $i++) {
                Lot::create([
                    'hari' => $i,
                    'sasaran' => '1000',
                    'jumlah_lot' => '100',
                    'masjid_id' => auth()->user()->masjids->masjid->id,
                    'ramadhan_id' => $ramadhan->id,
                    'description' => 'Iftar/Moreh/Bubur Lambuk',
                    'quota' => 10
                ]);
            }
        }

        // $redirect_location = $this->traitStore();

        return redirect(backpack_url('/ramadhan'));
    }

    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->setupCreateOperation();
    }
}
