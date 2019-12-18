<?php

class UtilidadesVarias {
   
	public static function textofechahora($datetime) {

		$fecha = date_create($datetime);

		$diatxt = date_format($fecha, 'l');
		$dianro = date_format($fecha, 'd');
		$mestxt = date_format($fecha, 'F');
		$anionro = date_format($fecha, 'Y');

		$hora = date_format($fecha, 'g');
		$min = date_format($fecha, 'i');
		$jorn = date_format($fecha, 'A');
		
		// *********** traducciones y modificaciones de fechas a letras y a español ***********
		$ding=array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		$ming=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$mesp=array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$desp=array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
		$mesn=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		$diaesp=str_replace($ding, $desp, $diatxt);
		$mesesp=str_replace($ming, $mesp, $mestxt);

		return $diaesp.", ".$dianro." de ".$mesesp." de ".$anionro.' - '.$hora.':'.$min.' '.$jorn;	

	}

	public static function textofecha($date) {

		$fecha = date_create($date);

		$diatxt = date_format($fecha, 'l');
		$dianro = date_format($fecha, 'd');
		$mestxt = date_format($fecha, 'F');
		$anionro = date_format($fecha, 'Y');
		
		// *********** traducciones y modificaciones de fechas a letras y a español ***********
		$ding=array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday');
		$ming=array('January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December');
		$mesp=array('Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre');
		$desp=array('Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado', 'Domingo');
		$mesn=array('01', '02', '03', '04', '05', '06', '07', '08', '09', '10', '11', '12');
		$diaesp=str_replace($ding, $desp, $diatxt);
		$mesesp=str_replace($ming, $mesp, $mestxt);

		return $diaesp.", ".$dianro." de ".$mesesp." de ".$anionro;	
	}

	public static function estadofechavencimiento($opc, $id) {
		//recibe parametro de tabla, pk de la tabla a consultar

		if($opc == 1){

			$modelopcnacional = PcNacional::model()->findByPk($id);

			if($modelopcnacional->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelopcnacional->Fecha_Final) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelopcnacional->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelopcnacional->Dias_Alerta){
					return "label-success";
				}

			}

		}

		if($opc == 2){

			$modelopcexterior = PcExterior::model()->findByPk($id);

			if($modelopcexterior->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelopcexterior->Fecha_Final) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelopcexterior->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelopcexterior->Dias_Alerta){
					return "label-success";
				}

			}

		}

		if($opc == 3){

			$modelopcprojur = PcProcJur::model()->findByPk($id);

			if($modelopcprojur->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelopcprojur->Fecha_Contestacion) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelopcprojur->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelopcprojur->Dias_Alerta){
					return "label-success";
				}

			}

		}

		if($opc == 4){

			$modelopccontrato = PcContrato::model()->findByPk($id);

			if($modelopccontrato->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelopccontrato->Fecha_Ren_Can) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelopccontrato->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelopccontrato->Dias_Alerta){
					return "label-success";
				}

			}

		}

		if($opc == 5){

			$modelopcregistro = PcRegistro::model()->findByPk($id);

			if($modelopcregistro->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelopcregistro->Fecha_Final) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelopcregistro->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelopcregistro->Dias_Alerta){
					return "label-success";
				}

			}

		}

		if($opc == 6){

			$modelocon = Cont::model()->findByPk($id);

			if($modelocon->Estado == 0){

				return "label-default";

			}else{

				$str = strtotime($modelocon->Fecha_Ren_Can) - strtotime(date('Y-m-d'));
				$diff = floor($str/3600/24);

				if ($diff < $modelocon->Dias_Alerta){
					return "label-danger";
				}

				if ($diff >= $modelocon->Dias_Alerta){
					return "label-success";
				}

			}

		}
		
	}

	public static function textoestado1($opc) {

		if($opc == 0){
			return 'INACTIVO';
		}

		if($opc == 1){
			return 'ACTIVO';	
		}
	}


	public static function textoestado2($opc) {

		if($opc == 0){
			return 'NO';
		}

		if($opc == 1){
			return 'SI';	
		}
	}

	public static function descequipo($equipo) {
		$modeloequipo = Equipo::model()->findByPk($equipo);
		return $modeloequipo->tipoequipo->Dominio.' / '.$modeloequipo->Serial;
	}

	public static function novedaditem($id, $item_act, $item_nue, $descripcion_act, $descripcion_nue, $cant_act, $cant_nue, $vlr_unit_act, $vlr_unit_nue, $estado_act, $estado_nue){

		$texto_novedad = "";
		$flag = 0;

		if($item_act != $item_nue){
			$flag = 1;

			$texto_novedad .= "Item: ".$item_act." / ".$item_nue.", ";
		}

		if($descripcion_act != $descripcion_nue){
			$flag = 1;

			$texto_novedad .= "Descripción: ".$descripcion_act." / ".$descripcion_nue.", ";
		}

		if($cant_act != $cant_nue){
			$flag = 1;

			$texto_novedad .= "Cant.: ".$cant_act." / ".$cant_nue.", ";
		}

		if($vlr_unit_act != $vlr_unit_nue){
			$flag = 1;

			$texto_novedad .= "Vlr. unit.: ".number_format($vlr_unit_act, 0)." / ".number_format($vlr_unit_nue, 0).", ";
		}

		if($estado_act != $estado_nue){
			$flag = 1;

			$texto_novedad .= "Estado: ".UtilidadesVarias::textoestado1($estado_act)." / ".UtilidadesVarias::textoestado1($estado_nue).", ";
		}

		//alguno de los criterios cambio
		if($flag == 1){
			$texto_novedad = substr ($texto_novedad, 0, -2);
			$nueva_novedad = new HistItemCont;
			$nueva_novedad->Id_Item = $id;
			$nueva_novedad->Novedad = $texto_novedad;
			$nueva_novedad->Id_Usuario_Creacion = Yii::app()->user->getState('id_user');
			$nueva_novedad->Fecha_Creacion = date('Y-m-d H:i:s');
			$nueva_novedad->save();
		}
	}


}
