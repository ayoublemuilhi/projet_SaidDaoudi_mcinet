<?php
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name_fr' =>'dashboard' , 'name_ar' => 'الرئيسية']);
        Permission::create(['name_fr' =>'Liste des secteurs' , 'name_ar' => 'قائمة القطاعات']);
        Permission::create(['name_fr' =>'Liste des indicateurs' , 'name_ar' => 'قائمة المؤشرات']);
        Permission::create(['name_fr' =>'Liste resource Humaines' , 'name_ar' => 'قائمة الموارد البشرية']);

        Permission::create(['name_fr' =>'Liste utilisateurs' , 'name_ar' => 'قائمة المستخدمين']);
        Permission::create(['name_fr' =>'Liste rôles Utilisateurs' , 'name_ar' => 'قائمة أدوار المستخدمين']);
        Permission::create(['name_fr' =>"Affichage d'utilisateurs" , 'name_ar' => 'عرض المستخدمين']);
        Permission::create(['name_fr' =>'Ajouter un utilisateur' , 'name_ar' => 'إضافة مستخدم']);
        Permission::create(['name_fr' =>'modifier un utilisateur' , 'name_ar' => 'تعديل مستخدم']);
        Permission::create(['name_fr' =>'supprimer un utilisateur' , 'name_ar' => 'حذف مستخدم']);
        Permission::create(['name_fr' =>'Activer un utilisateur' , 'name_ar' => 'تفعيل مستخدم']);
        Permission::create(['name_fr' =>'Bloquer un utilisateur' , 'name_ar' => 'حظر  مستخدم']);
        Permission::create(['name_fr' =>'restore un utilisateur' , 'name_ar' => 'استعادة مستخدم']);
        Permission::create(['name_fr' =>'visualisez un utilisateur' , 'name_ar' => ' عرض المستخدم']);//fas fa eye

        Permission::create(['name_fr' =>'Affichage des Roles' , 'name_ar' => 'عرض الأدوار']);
        Permission::create(['name_fr' =>'Ajouter un rôle' , 'name_ar' => 'اضافة دور']);
        Permission::create(['name_fr' =>'Modifer un rôle' , 'name_ar' => 'تعديل دور']);
        Permission::create(['name_fr' =>'Supprimer un rôle' , 'name_ar' => 'حذف دور']);
        Permission::create(['name_fr' =>'visualisez un role' , 'name_ar' => 'عرض دور']);
        Permission::create(['name_fr' =>'restore un role' , 'name_ar' => 'استعادة دور']);



    }
}
