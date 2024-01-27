<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\MasjidRequest;
use App\Models\Masjid;
use App\Models\MasjidUser;
use Backpack\CRUD\app\Http\Controllers\CrudController;
use Backpack\CRUD\app\Library\CrudPanel\CrudPanelFacade as CRUD;
use Illuminate\Support\Facades\Auth;

/**
 * Class MasjidCrudController
 * @package App\Http\Controllers\Admin
 * @property-read \Backpack\CRUD\app\Library\CrudPanel\CrudPanel $crud
 */
class MasjidCrudController extends CrudController
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
        CRUD::setModel(\App\Models\Masjid::class);
        CRUD::setRoute(config('backpack.base.route_prefix') . '/masjid');
        CRUD::setEntityNameStrings('masjid', 'masjids');
    }

    /**
     * Define what happens when the List operation is loaded.
     * 
     * @see  https://backpackforlaravel.com/docs/crud-operation-list-entries
     * @return void
     */
    protected function setupListOperation()
    {
        // CRUD::column('id');
        CRUD::column('name');
        CRUD::column('location');
        CRUD::column('short_name');
        CRUD::column('phone');
        CRUD::column('toyyibpay_secret_key');
        CRUD::column('toyyibpay_collection_id');
        // CRUD::column('created_at');
        // CRUD::column('updated_at');

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
        CRUD::setValidation(MasjidRequest::class);

        CRUD::field('name');
        CRUD::field('short_name');
        CRUD::field('location');

        CRUD::field('toyyibpay_secret_key');
        CRUD::field('toyyibpay_collection_id');

        $this->crud->addfield([
            'name' => 'phone', // Replace with the actual field name
            'type' => 'number',
            'label' => 'No Telefon Pentadbir',
            'hint' => 'Contoh: 60132465974'
        ]);

        CRUD::addField([
            'name' => 'offline',
            'label' => 'System Offline',
            'type' => 'select_from_array',
            'options' => ['1' => 'Online', '0' => 'Offline']
        ]);

        if ($this->crud->getActionMethod() == 'edit' || $this->crud->getActionMethod() == 'update') {
            CRUD::addField(
                [
                    'name'      => 'photo',
                    'label'     => 'Photo',
                    'type'      => 'upload',
                    'upload'    => true,
                ]
            );

            CRUD::addField(
                [
                    'name'      => 'cover',
                    'label'     => 'Cover',
                    'type'      => 'upload',
                    'upload'    => true,
                ]
            );
        }
    }

    protected function store()
    {
        // dd(request()->all());

        $user = Auth::user();

        // Check if the user has a masjid_user record
        if (!$user->masjids()->exists() || auth()->user()->hasRole('Superadmin')) {
            // If not, create a masjid_user record
            $masjid = Masjid::create([
                'name' => request()->name,
                'location' => request()->location,
                'short_name' => request()->short_name,
                'phone' => request()->phone,
                'toyyibpay_secret_key' => request()->toyyibpay_secret_key,
                'toyyibpay_collection_id' => request()->toyyibpay_collection_id,
                'photo' => request()->photo,
            ]);

            if (auth()->user()->hasRole('Admin')) {
                MasjidUser::create([
                    'masjid_id' => $masjid->id,
                    'user_id' => auth()->user()->id
                ]);

                $user->assignRole('Admin');
            }
        }

        if (auth()->user()->hasRole('Superadmin')) {
            return redirect(backpack_url('/masjid'));
        }
        return redirect(backpack_url('/dashboard'));
    }


    /**
     * Define what happens when the Update operation is loaded.
     * 
     * @see https://backpackforlaravel.com/docs/crud-operation-update
     * @return void
     */
    protected function setupUpdateOperation()
    {
        $this->crud->removeSaveActions(['save_and_back', 'save_and_new', 'save_and_preview']);
        $this->setupCreateOperation();
    }
}