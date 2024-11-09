<?php

class ABMCompraItem {
    /**
     * Carga un objeto desde un arreglo asociativo.
     * @param array $param
     * @return object
     */
    private function cargarObjeto($param) {
        $objCompraItem = null;
        if (array_key_exists('idcompraitem',$param) && array_key_exists('idproducto',$param) && array_key_exists('idcompra',$param) && array_key_exists('cicantidad',$param)) {
            $objCompraItem = new CompraItem();
            $objProducto = null;
            $objCompra = null;
            if ($param['idproducto'] != null) {
                $objProducto = new Producto();
                $objProducto->setIdProducto($param['idproducto']);
                $objProducto->cargar();
            }
            if ($param['idcompra'] != null) {
                $objCompra = new Compra();
                $objCompra->setIdCompra($param['idcompra']);
                $objCompra->cargar();
            }
            $objCompraItem->setear($param['idcompraitem'], $objProducto, $objCompra, $param['cicantidad']);
        }
        return $objCompraItem;
    }

    /**
     * Carga un objeto con clave.
     * @param array $param
     * @return CompraItem|null
     */
    private function cargarObjetoConClave($param) {
        $objCompraItem = null;
        if (isset($param['idcompraitem']) ){
            $objCompraItem = new CompraItem();
            $objCompraItem->setear($param['idcompraitem'], null, null, null);
        }
        return $objCompraItem;
    }

    /**
     * Corrobora que dentro del arreglo asociativo estan seteados los campos claves.
     * @param array $param
     * @return boolean
     */
    private function seteadosCamposClaves($param) {
        return isset($param['idcompraitem']);
    }

    /**
     * Permite insertar un nuevo objeto.
     * @param array $param
     * @return boolean
     */
    public function alta($param) {
        $resp = false;
        $param['idcompraitem'] = null;
        $objCompraItem = $this->cargarObjeto($param);
        if ($objCompraItem != null && $objCompraItem->insertar()) {
                $resp = true;
        }
        return $resp;
    }

    /**
     * Permite eliminar un objeto.
     * @param array $param
     * @return boolean
     */
    public function baja($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjetoConClave($param);
            if ($objCompraItem != null && $objCompraItem->eliminar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite modificar un objeto.
     * @param array $param
     * @return boolean
     */
    public function modificacion($param) {
        $resp = false;
        if ($this->seteadosCamposClaves($param)) {
            $objCompraItem = $this->cargarObjeto($param);
            if ($objCompraItem != null && $objCompraItem->modificar()) {
                $resp = true;
            }
        }
        return $resp;
    }

    /**
     * Permite buscar un objeto.
     * @param array $param
     * @return array
     */
    public function buscar($param = "") {
        $where = " true ";
        if ($param <> NULL) {
            if  (isset($param['idcompraitem']))
                $where.=" and idcompraitem ='".$param['idcompraitem']."'";
            if  (isset($param['idproducto']))
                $where.=" and idproducto ='".$param['idproducto']."'";
            if  (isset($param['idcompra']))
                $where.=" and idcompra ='".$param['idcompra']."'";
            if  (isset($param['cicantidad']))
                $where.=" and cicantidad ='".$param['cicantidad']."'";
        }
        $objCompraItem = new CompraItem();
        $arregloCompraItem = $objCompraItem->listar($where);
        return $arregloCompraItem;
    }
}

?>