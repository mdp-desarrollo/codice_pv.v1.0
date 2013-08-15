<?php
defined('SYSPATH') or die ('no tiene acceso');
//descripcion del modelo productos
class Model_Pvprogramaticas extends ORM{
    protected $_table_names_plural = false;
    
    public function listafuentes($id){
        $sql = "select p.id, concat(p.codigo_entidad,'-',da.codigo_da,'-',ue.codigo_ue,'-' , prog.codigo,'-', proy.codigo,'-', act.codigo,'-',fte.codigo,'-', org.codigo,' : ', act.actividad) actividad
                from pyvprogramatica p 
                inner join pyvunidadfuncional da on p.id_da = da.id
                inner join pyvunidadfuncional ue on p.id_ue = ue.id
                inner join pyvactividadppt act on p.id_actividadppt = act.id 
                inner join pyvfuente fte on p.id_fuente = fte.id
                inner join pyvorganismo org on p.id_organismo = org.id
                inner join pyvprograma prog on p.id_programa = prog.id
                inner join pyvproyecto proy on p.id_proyecto = proy.id
                where p.id_unidad_funcional = $id
                or act.actividad = 'GESTION ADMINISTRATIVA FINANCIERA'";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    public function ejecucion(){
        $sql = "select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, da.codigo_da, ue.codigo_ue, 
                prog.codigo codigo_prog, proy.codigo codigo_proy, act.codigo codigo_act, act.actividad,
                fte.codigo codigo_fte, fte.sigla sigla_fuente,
                org.codigo codigo_org, org.sigla sigla_org
                from pyvprogramatica p inner join pyvunidadfuncional da on p.id_da = da.id
                inner join pyvunidadfuncional uni on p.id_unidad_funcional = uni.id inner join oficinas of on uni.id_oficina = of.id
                inner join pyvunidadfuncional ue on p.id_ue = ue.id
                inner join pyvprograma prog on p.id_programa = prog.id
                inner join pyvproyecto proy on p.id_proyecto = proy.id 
                inner join pyvactividadppt act on p.id_actividadppt = act.id
                inner join pyvfuente fte on p.id_fuente = fte.id
                inner join pyvorganismo org on p.id_organismo = org.id";
        //return $this->_db->query(Database::SELECT, $sql, TRUE);
        return DB::query(1, $sql)->execute();
    }
    
    public function saldopresupuesto($id){
        $sql = "select part.codigo, eje.id, part.partida, eje.inicial, eje.modificado, eje.vigente, eje.preventivo, eje.comprometido, eje.devengado, eje.saldo_devengado, eje.pagado, eje.saldo_pagar
                from pyvprogramatica pro 
                inner join pyvejecucion eje on eje.id_programatica = pro.id
                inner join pyvpartidas part on eje.id_partida = part.id
                where pro.id = $id";
        //return $this->_db->query(Database::SELECT, $sql, TRUE);
        return DB::query(1, $sql)->execute();
    }
       
    public function detallesaldopresupuesto($id){
        $sql = "select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, p.entidad, 
da.codigo_da, of_da.oficina da, ue.codigo_ue, of_ue.oficina ue,
                prog.codigo codigo_prog, proy.codigo codigo_proy, act.codigo codigo_act, act.actividad,
                fte.codigo codigo_fte, fte.denominacion fuente,
                org.codigo codigo_org, org.denominacion organismo
                from pyvprogramatica p 
                inner join pyvunidadfuncional uni on p.id_unidad_funcional = uni.id inner join oficinas of on uni.id_oficina = of.id
                inner join pyvunidadfuncional da on p.id_da = da.id inner join oficinas of_da on da.id_oficina = of_da.id
                inner join pyvunidadfuncional ue on p.id_ue = ue.id inner join oficinas of_ue on ue.id_oficina = of_ue.id
                inner join pyvprograma prog on p.id_programa = prog.id
                inner join pyvproyecto proy on p.id_proyecto = proy.id 
                inner join pyvactividadppt act on p.id_actividadppt = act.id
                inner join pyvfuente fte on p.id_fuente = fte.id
                inner join pyvorganismo org on p.id_organismo = org.id
                where p.id = $id";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
        //return DB::query(1, $sql)->execute();
    }
    
    public function listadetallefuentes($id){
        $sql = "select p.id, concat(p.codigo_entidad,'-',da.codigo_da,'-',ue.codigo_ue,'-' , prog.codigo,'-', proy.codigo,'-', act.codigo,'-',fte.codigo,'-', org.codigo,' : ', act.actividad) actividad
                from pyvprogramatica p 
                inner join pyvunidadfuncional da on p.id_da = da.id
                inner join pyvunidadfuncional ue on p.id_ue = ue.id
                inner join pyvactividadppt act on p.id_actividadppt = act.id 
                inner join pyvfuente fte on p.id_fuente = fte.id
                inner join pyvorganismo org on p.id_organismo = org.id
                inner join pyvprograma prog on p.id_programa = prog.id
                inner join pyvproyecto proy on p.id_proyecto = proy.id
                where p.id = $id";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }
    
    /*public function fuente($id){
        $sql = "select distinct (concat(cat.programa,'-',cat.proyecto,'-',cat.actividad,'-', o.oficina)) id_fuente, concat( cat.cat_programatica,'---',o.oficina) cat_programatica
from pyvunidadfuncional u inner join oficinas o on u.id_oficina = o.id
inner join pyvobjetivogestion og on u.id = og.id_unidad_funcional
inner join pyvobjetivoespecifico oe on og.id_obj_gestion = oe.id_obj_gestion
inner join pyvobjespcatprog obcp on oe.id_obj_especifico = obcp.id_objetivoespecifico
inner join pyvcatprogramatica cat on obcp.id_catprogramatica =cat.id
inner join pyvestructuraprogramatica est on cat.id = est.id_cat_programatica
inner join pyvfuente f on est.id_fuente = f.id
inner join pyvorganismo org on est.id_organismo = org.id
where u.id = $id";
      return $this->_db->query(Database::SELECT,$sql,TRUE);  
    }*/

    
    //para ACtividades del Presupuesto
    /*public function fuente($id){
        $sql = "select distinct ep.cod_entidad cod_entidad, ep.desc_entidad entidad, 
                da.codigo_da cod_da, of1.oficina da,
                ue.codigo_ue cod_ue, of2.oficina ue,
                org.codigo cod_org, org.sigla sigla_org , org.denominacion org, 
                fte.codigo cod_fuente, fte.sigla sigla_fuente, fte.denominacion fuente,
                pro.codigo cod_prog, pro.programa prog, 
                #pry.codigo, pry.proyecto,
                act.codigo cod_act, act.actividad act
                from pyvestructuraprogramatica ep
                inner join pyvorganismo org on ep.id_organismo = org.id
                inner join pyvfuente fte on ep.id_fuente = fte.id
                inner join pyvcatprogramatica cat on ep.id_cat_programatica = cat.id
                inner join pyvprograma pro on cat.id_programa = pro.id
                #inner join pyvproyecto pry on cat.id_proyecto = pry.id
                inner join pyvactividadppt act on cat.id_actividad = act.id
                inner join pyvunidadfuncional ue on ep.id_ue_ppt = ue.id
                inner join oficinas of1 on ue.id_oficina = of1.id
                inner join pyvunidadfuncional da on ep.id_da = da.id
                inner join oficinas of2 on da.id_oficina = of2.id 
                where ep.id_unidad_funcional =  $id";
        return $this->_db->query(Database::SELECT, $sql, TRUE);
    }*/
    

  /*  
    public function disponible($uf, $da, $ue, $org, $fte, $cat){
        $sql = "select part.codigo, part.partida, e.ppto_vigente
                from pyvestructuraprogramatica e inner join pyvpartidas part on e.id_partida = part.id
                where e.id_unidad_funcional = $uf 
                and e.id_da = $da
                and e.id_ue_ppt = $ue
                and e.id_organismo = $org
                and e.id_fuente = $fte
                and e.id_cat_programatica = $cat";
        //return $this->_db->query(Database::SELECT, $sql, TRUE);
        return DB::query(1, $sql)->execute();
    }*/
    
    
}
?>