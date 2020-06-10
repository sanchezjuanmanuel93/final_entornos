<?php

namespace App\Services;

use App\MenuItem;
use App\MenuItemGroup;
use App\Rol;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Arr;

class MenuItemsService
{
    private $menuItems;

    public function __construct()
    {
        $this->menuItems = collect([
            new MenuItemGroup(
                "Vacantes",
                [
                    new MenuItem("Abrir Vacante", "vacante.create", "fa-plus", [Rol::$RESPONSABLE_ADMINISTRATIVO]),
                    new MenuItem("Consultar Vacantes Abiertas", "consultar-vacantes-abiertas", "fa-list-ul", [Rol::$POSTULANTE]),
                    new MenuItem("Consultar Vacantes", "vacante.index", "fa-list-ul", [Rol::$RESPONSABLE_ADMINISTRATIVO])
                ],
                [Rol::$RESPONSABLE_ADMINISTRATIVO, Rol::$POSTULANTE]
            ),
            new MenuItemGroup(
                "Postulaciones",
                [
                    new MenuItem("Mis Postulaciones", "consultar-postulaciones", "fa-plus", [Rol::$POSTULANTE])
                ],
                [Rol::$POSTULANTE]
            ),
            new MenuItemGroup(
                "Usuarios",
                [
                    new MenuItem("Crear Usuario", "alta-usuario", "fa-plus", [Rol::$ADMINISTRADOR]),
                    new MenuItem("Consultar Usuarios", "consultar-usuarios", "fa-list-ul", [Rol::$ADMINISTRADOR])
                ],
                [Rol::$ADMINISTRADOR]
            ),
            new MenuItemGroup(
                "Soporte",
                [
                    new MenuItem("Consultar FAQs", "consultar-faqs", "fa-info-circle", [Rol::$POSTULANTE, Rol::$RESPONSABLE_ADMINISTRATIVO, Rol::$ADMINISTRADOR]),
                    new MenuItem("Solicitar Soporte", "solicitar-soporte", "fa-question-circle", [Rol::$POSTULANTE, Rol::$RESPONSABLE_ADMINISTRATIVO, Rol::$ADMINISTRADOR])
                ],
                [Rol::$POSTULANTE, Rol::$RESPONSABLE_ADMINISTRATIVO, Rol::$ADMINISTRADOR]
            )
        ]);
    }


    /**
     * Get Menu Items Grouped.
     *
     * @return \App\MenuItemGroup[]
     */
    public function getMenuItemsGrouped()
    {
        $rol = Auth::user()->rol->id;
        $menuItemsGrouped = [];
        
        foreach ($this->filterByRol($this->menuItems, $rol) as $group) {
            $menuItems = [];
            foreach ($this->filterByRol($group->menuItems, $rol) as $item) {
                $menuItems[] = $item;
            }
            $menuItemsGrouped[] = new MenuItemGroup($group->groupName, $menuItems, $group->roles);
        }
        return $menuItemsGrouped;
    }


    /**
     * Get Menu Items.
     *
     * @return \App\MenuItem[]
     */
    public function getMenuItems()
    {
        $rol = Auth::user()->rol->id;
        $menuItems = [];
        foreach ($this->filterByRol($this->menuItems, $rol) as $group) {
            foreach ($this->filterByRol($group->menuItems, $rol) as $item) {
                $menuItems[] = $item;
            }
        }
        return $menuItems;
    }

    private function filterByRol($list, $rol)
    {
        $listFiltered = [];
        foreach ($list as  $item) {
            if ($item->roles->contains($rol)) {
                $listFiltered[] = $item;
            }
        }
        return collect($listFiltered);
    }
}
