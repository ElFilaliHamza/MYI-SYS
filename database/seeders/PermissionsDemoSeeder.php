<?php 

namespace Database\Seeders;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PermissionsDemoSeeder extends Seeder
{

    public function run(): void
    {
        $superAdminRole = Role::create(['name' => 'super-admin']);

        // create permissions
        Permission::create(['name' => 'create Client']);
        Permission::create(['name' => 'delete Client']);
        Permission::create(['name' => 'update Client']);
        Permission::create(['name' => 'read Client']);
        Permission::create(['name' => 'create Articles']);
        Permission::create(['name' => 'delete Articles']);
        Permission::create(['name' => 'update Articles']);
        Permission::create(['name' => 'read Articles']);
        Permission::create(['name' => 'create Articles en kits']);
        Permission::create(['name' => 'delete Articles en kits']);
        Permission::create(['name' => 'update Articles en kits']);
        Permission::create(['name' => 'read Articles en kits']);
        Permission::create(['name' => 'create Fournisseurs']);
        Permission::create(['name' => 'delete Fournisseurs']);
        Permission::create(['name' => 'update Fournisseurs']);
        Permission::create(['name' => 'read Fournisseurs']);
        Permission::create(['name' => 'entrée stock']);
        Permission::create(['name' => 'ventes']);
        Permission::create(['name' => 'create Employés']);
        Permission::create(['name' => 'delete Employés']);
        Permission::create(['name' => 'update Employés']);
        Permission::create(['name' => 'read Employés']);
        Permission::create(['name' => 'create Dépenses']);
        Permission::create(['name' => 'delete Dépenses']);
        Permission::create(['name' => 'update Dépenses']);
        Permission::create(['name' => 'read Dépenses']);
        Permission::create(['name' => 'create Dépenses catégorie']);
        Permission::create(['name' => 'delete Dépenses catégorie']);
        Permission::create(['name' => 'update Dépenses catégorie']);
        Permission::create(['name' => 'read Dépenses catégorie']);
        Permission::create(['name' => 'create Encaissements']);
        Permission::create(['name' => 'delete Encaissements']);
        Permission::create(['name' => 'update Encaissements']);
        Permission::create(['name' => 'read Encaissements']);

        $permissions = Permission::all();
        $superAdminRole->syncPermissions($permissions);

       

    }
}