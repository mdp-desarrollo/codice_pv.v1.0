<?php defined('SYSPATH') or die('No direct script access.'); ?>

<<<<<<< HEAD
2013-08-15 14:09:28 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pvpasajes' not found ~ APPPATH\classes\controller\pvpasajes.php [ 40 ]
2013-08-15 14:10:11 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pvpasajes' not found ~ APPPATH\classes\controller\pvpasajes.php [ 40 ]
2013-08-15 14:10:59 --- ERROR: ErrorException [ 2 ]: Missing argument 1 for Model_Pvpasajes::listaautorizados(), called in E:\sistemas\codice_pv\application\classes\controller\pvpasajes.php on line 41 and defined ~ APPPATH\classes\model\pvpasajes.php [ 23 ]
2013-08-15 14:12:12 --- ERROR: ErrorException [ 8 ]: Undefined variable: id ~ APPPATH\classes\model\pvpasajes.php [ 21 ]
2013-08-15 14:12:28 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvfucov' doesn't exist ( select memo.id id_memo, memo.codigo memo, memo.nur, fcv.nombre_user_comision nombre, fcv.cargo_user_comision cargo,
                fcv.fecha_creacion, of.oficina unidad, 
                pas.fecha_salida salida, pas.fecha_retorno retorno, pas.empresa_salida, pas.num_boleto_salida
                from documentos memo
                inner join pyvfucov fcv on fcv.id_memo = memo.id
                inner join pyvpasajes pas on fcv.id = pas.id_fucov
                inner join pyvunidadfuncional uni on uni.id = fcv.id_unidad_funcional
                inner join oficinas of on of.id = uni.id_oficina
                where memo.fucov = 1
                and fcv.id_memo  0
                and pas.fecha_autorizacion  ''
                and pas.etapa_proceso = 1 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 14:53:44 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pvliquidaciones' not found ~ APPPATH\classes\controller\pvpresupuesto.php [ 40 ]
2013-08-15 14:55:43 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pvliquidaciones' not found ~ APPPATH\classes\controller\pvpresupuesto.php [ 40 ]
2013-08-15 14:56:55 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvfucov' doesn't exist ( select memo.id id_memo, memo.codigo memo, memo.nur, fcv.nombre_user_comision nombre, fcv.cargo_user_comision cargo,
fcv.fecha_creacion, of.oficina unidad, fcv.id id_fucov
from documentos memo
inner join pyvfucov fcv on fcv.id_memo = memo.id
inner join pyvliquidacion liq on liq.id_fucov = fcv.id 
inner join pyvunidadfuncional uni on uni.id = fcv.id_unidad_funcional
inner join oficinas of on of.id = uni.id_oficina
where memo.fucov = 1
and fcv.id_memo  0
and liq.id_programatica 0 ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 15:05:44 --- ERROR: ErrorException [ 8 ]: Undefined variable: menu ~ APPPATH\views\pvpresupuesto\index.php [ 44 ]
2013-08-15 15:11:04 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pyvprogramatica' not found ~ APPPATH\classes\controller\pvpresupuesto.php [ 51 ]
2013-08-15 15:12:03 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pyvprogramatica' not found ~ APPPATH\classes\controller\pvpresupuesto.php [ 51 ]
2013-08-15 15:15:09 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pvprogramatica' doesn't exist ( SHOW FULL COLUMNS FROM `pvprogramatica` ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 15:17:28 --- ERROR: ErrorException [ 1 ]: Class 'Model_Pvprogramaticas' not found ~ APPPATH\classes\controller\pvpresupuesto.php [ 51 ]
2013-08-15 15:17:54 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvprogramatica' doesn't exist ( select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, da.codigo_da, ue.codigo_ue, 
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
                inner join pyvorganismo org on p.id_organismo = org.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 15:46:06 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvprogramatica' doesn't exist ( select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, da.codigo_da, ue.codigo_ue, 
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
                inner join pyvorganismo org on p.id_organismo = org.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 19:01:02 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvprogramatica' doesn't exist ( select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, da.codigo_da, ue.codigo_ue, 
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
                inner join pyvorganismo org on p.id_organismo = org.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
2013-08-15 19:01:31 --- ERROR: Database_Exception [ 0 ]: [1146] Table 'correspondencia_pv.pyvprogramatica' doesn't exist ( select p.id, of.oficina unidad_funcional, p.gestion, p.codigo_entidad, da.codigo_da, ue.codigo_ue, 
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
                inner join pyvorganismo org on p.id_organismo = org.id ) ~ MODPATH\database\classes\kohana\database\mysql.php [ 181 ]
=======
2013-08-15 10:21:33 --- ERROR: ErrorException [ 8 ]: Undefined index: fucov ~ APPPATH/classes/controller/documento.php [ 119 ]
2013-08-15 10:23:01 --- ERROR: ErrorException [ 8 ]: Undefined index: fucov ~ APPPATH/classes/controller/documento.php [ 119 ]
2013-08-15 10:24:14 --- ERROR: ErrorException [ 8 ]: Undefined index: fucov ~ APPPATH/classes/controller/documento.php [ 119 ]
2013-08-15 10:38:41 --- ERROR: ErrorException [ 8 ]: Undefined index: fucov ~ APPPATH/classes/controller/documento.php [ 119 ]
2013-08-15 10:43:55 --- ERROR: ErrorException [ 8 ]: Undefined index: fucov ~ APPPATH/classes/controller/documento.php [ 99 ]
2013-08-15 10:53:49 --- ERROR: ErrorException [ 8 ]: Undefined index: observaciones ~ APPPATH/classes/controller/documento.php [ 117 ]
2013-08-15 11:26:32 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '0' for key 'PRIMARY' ( INSERT INTO `pvcomisiones` (`id_documento`, `detalle_comision`, `origen`, `destino`, `fecha_inicio`, `fecha_fin`, `observacion`, `estado`) VALUES (6828, 'ddddddddddd', 'dddddddd', 'dddddddddddd', '1969-12-31 11:04:38', '1969-12-31 11:04:38', 'dddddddddd', 1) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-15 11:27:22 --- ERROR: Database_Exception [ 0 ]: [1062] Duplicate entry '0' for key 'PRIMARY' ( INSERT INTO `pvcomisiones` (`id_documento`, `detalle_comision`, `origen`, `destino`, `fecha_inicio`, `fecha_fin`, `observacion`, `estado`) VALUES (6829, 'qqqqqqqqqqq', 'qqqqqqqqq', 'qqqqqqqqqqqqqq', '2013-08-15 11:26:33', '2013-08-30 11:26:33', 'qqqqqqqqqqqqq', 1) ) ~ MODPATH/database/classes/kohana/database/mysql.php [ 181 ]
2013-08-15 14:37:59 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH/orm/classes/kohana/orm.php [ 682 ]
2013-08-15 14:39:51 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH/orm/classes/kohana/orm.php [ 682 ]
2013-08-15 14:39:52 --- ERROR: Kohana_Exception [ 0 ]: The tipo property does not exist in the Model_Documentos class ~ MODPATH/orm/classes/kohana/orm.php [ 682 ]
2013-08-15 14:50:31 --- ERROR: ErrorException [ 8 ]: Object of class Model_Pvcomisiones could not be converted to int ~ APPPATH/views/documentos/edit.php [ 200 ]
2013-08-15 14:50:33 --- ERROR: ErrorException [ 8 ]: Object of class Model_Pvcomisiones could not be converted to int ~ APPPATH/views/documentos/edit.php [ 200 ]
2013-08-15 14:52:02 --- ERROR: ErrorException [ 8 ]: Object of class Model_Pvcomisiones could not be converted to int ~ APPPATH/views/documentos/edit.php [ 200 ]
2013-08-15 15:16:30 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/documentos/edit.php [ 402 ]
2013-08-15 15:18:02 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/documentos/edit.php [ 402 ]
2013-08-15 15:19:03 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/documentos/edit.php [ 402 ]
2013-08-15 15:44:21 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$origen ~ APPPATH/views/documentos/edit.php [ 402 ]
2013-08-15 15:46:25 --- ERROR: ErrorException [ 8 ]: Undefined property: Database_MySQL_Result::$origen ~ APPPATH/views/documentos/edit.php [ 402 ]
2013-08-15 16:16:13 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/documentos/edit.php [ 354 ]
2013-08-15 16:22:25 --- ERROR: ErrorException [ 8 ]: Trying to get property of non-object ~ APPPATH/views/documentos/edit.php [ 372 ]
2013-08-15 16:34:25 --- ERROR: ErrorException [ 8 ]: Use of undefined constant Vie - assumed 'Vie' ~ APPPATH/views/documentos/edit.php [ 209 ]
2013-08-15 16:55:55 --- ERROR: ErrorException [ 8 ]: Use of undefined constant Vie - assumed 'Vie' ~ APPPATH/views/documentos/edit.php [ 209 ]
2013-08-15 17:03:27 --- ERROR: ErrorException [ 8 ]: Undefined variable: dia ~ APPPATH/views/documentos/edit.php [ 415 ]
>>>>>>> 7201867f9334e060322def9d3300304a3dd99c59
