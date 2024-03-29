<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TransaksiRequest;
use App\Models\Lot;
use App\Models\Ramadhan;
use App\Models\RamadhanTransaction;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;

/**
 * Class TransaksiCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class TransaksiCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Transaksi::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/transaksi');
        CRUD::setEntityNameStrings('transaksi', 'transaksi');
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
        CRUD::column('nama');
        CRUD::column('emel');
        CRUD::column('telefon');
        CRUD::column('hari');
        CRUD::column('jumlah');
        CRUD::column('status');
        CRUD::column('mark_as_paid');

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
        CRUD::setValidation(TransaksiRequest::class);

        CRUD::addField([
            'name' => 'nama',
            'type' => 'text'
        ]);
        CRUD::addField([
            'name' => 'emel',
            'type' => 'text'
        ]);
        CRUD::addField([
            'name' => 'telefon',
            'type' => 'text'
        ]);
        $ramadhan = [];
        for ($i = 1; $i < 31; $i++) {
            $ramadhan[$i] = $i . ' Ramadhan';
        }

        /* CRUD::addField([
            'name' => 'ramadhan',
            'label' => 'Ramadhan',
            'type' => 'select_from_array',
            'options' => $ramadhan
        ]); // hari */

        /*
        $lots = [];
        for ($i = 1; $i < 2; $i++) {
            $lots[$i] = $i . ' Lot';
        }
        CRUD::addField([
            'name' => 'kuantiti',
            'label' => 'Jumlah Lot',
            'type' => 'select_from_array',
            'options' => $lots
        ]);*/

        /*CRUD::addField([
            'name' => 'jumlah',
            'type' => 'number'
        ]);*/

        /*CRUD::addField([
            'name' => 'ramadhan_id',
            'label' => 'Tahun Ramadhan',
            'type' => 'select_from_array',
            'options' => Ramadhan::whereMasjidId(auth()->user()->masjids->masjid->id)->get()->pluck('tahun', 'id')->toArray()
        ]); // ramadhan ID */

        $lotMasjid = [];
        foreach (Lot::whereMasjidId(auth()->user()->masjids->masjid->id)->get() as $lot) {
            $lotMasjid[$lot->id] =
                // $lot->hari . ' Ramadhan. Quota: ' . ($lot->quota - $lot->transactions->where('status', 'paid')->count()) . '/' . $lot->quota . '. RM ' . $lot->sasaran . '. 1 Lot RM' . 
                // $lot->jumlah_lot . '. ' . $lot->description;

                $lot->hari . ' Ramadhan. Quota: ' . ($lot->quota - $lot->transactions->where('status', 'paid')->count()) . '/' . $lot->quota . '. 1 Lot RM' . $lot->jumlah_lot . '. ';
        }

        CRUD::addField([
            'name' => 'lot_id',
            'label' => 'Pilihan Lot',
            'type' => 'select_from_array',
            'options' => $lotMasjid
        ]);

        CRUD::addField([
            'name' => 'status',
            'label' => 'Status Bayaran',
            'type' => 'select_from_array',
            'options' => ['paid' => 'Bayar', 'unpaid' => 'Belom Bayar']
        ]);

        CRUD::addField([
            'name' => 'toyyibpay_ref',
            'label' => 'Keterangan',
            'type' => 'text'
        ]); // manual

        /**
         * Fields can be defined using the fluent syntax or array syntax:
         * - CRUD::field('price')->type('number');
         * - CRUD::addField(['name' => 'price', 'type' => 'number'])); 
         */
    }

    public function store(TransaksiRequest $request)
    {
        // Get Lot Details
        $lot = Lot::find(request()->lot_id);
        $quantity = 1;

        if (($lot->quota - $lot->transactions->where('status', 'paid')->count()) == 0) {
            \Alert::add('warning', 'Tempahan untuk lot ini sudah penuh.')->flash();
            return redirect()->back()->withInput();
        }

        // dd(request()->all(), $lot);

        // perform insert transaction
        $transaction = new RamadhanTransaction();
        $transaction->nama = request()->nama;
        $transaction->emel = request()->emel;
        $transaction->telefon = request()->telefon;
        $transaction->ramadhan = $lot->hari;
        $transaction->jumlah = $lot->jumlah_lot * $quantity;
        $transaction->kuantiti = $quantity;
        $transaction->toyyibpay_ref = request()->toyyibpay_ref;
        $transaction->status = request()->status;
        $transaction->ramadhan_id = $lot->ramadhan_id;
        $transaction->masjid_id = $lot->masjid_id;
        $transaction->lot_id = $lot->id;
        $transaction->save();

        return redirect()->to(backpack_url('/transaksi'))->with('success', true);
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

    public function update()
    {
        // Get Lot Details
        $lot = Lot::find(request()->lot_id);
        $quantity = 1;

        if (($lot->quota - $lot->transactions->where('status', 'paid')->count()) == 0) {
            \Alert::add('warning', 'Tempahan untuk lot ini sudah penuh.')->flash();
            return redirect()->back()->withInput();
        }

        // dd(request()->all(), $lot);

        // perform insert transaction
        $transaction = new RamadhanTransaction();
        $transaction->nama = request()->nama;
        $transaction->emel = request()->emel;
        $transaction->telefon = request()->telefon;
        $transaction->ramadhan = $lot->hari;
        $transaction->jumlah = $lot->jumlah_lot * $quantity;
        $transaction->kuantiti = $quantity;
        $transaction->toyyibpay_ref = request()->toyyibpay_ref;
        $transaction->status = request()->status;
        $transaction->ramadhan_id = $lot->ramadhan_id;
        $transaction->masjid_id = $lot->masjid_id;
        $transaction->lot_id = $lot->id;
        $transaction->save();

        return redirect()->to(backpack_url('/transaksi'))->with('success', true);
    }
}
