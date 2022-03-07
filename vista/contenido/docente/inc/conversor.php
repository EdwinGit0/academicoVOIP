<?php 

function unidad($numuero){
	switch ($numuero)
	{
		case 9:
		{
			$numu = "NUEVE";
			break;
		}
		case 8:
		{
			$numu = "OCHO";
			break;
		}
		case 7:
		{
			$numu = "SIETE";
			break;
		}		
		case 6:
		{
			$numu = "SEIS";
			break;
		}		
		case 5:
		{
			$numu = "CINCO";
			break;
		}		
		case 4:
		{
			$numu = "CUATRO";
			break;
		}		
		case 3:
		{
			$numu = "TRES";
			break;
		}		
		case 2:
		{
			$numu = "DOS";
			break;
		}		
		case 1:
		{
			$numu = "UNO";
			break;
		}		
		case 0:
		{
			$numu = "CERO";
			break;
		}		
	}
	return $numu;	
}

function decena($numdero){
	
		if ($numdero >= 90 && $numdero <= 99)
		{
			$numd = "NOVENTA ";
			if ($numdero > 90)
				$numd = $numd."Y ".(unidad($numdero - 90));
		}
		else if ($numdero >= 80 && $numdero <= 89)
		{
			$numd = "OCHENTA ";
			if ($numdero > 80)
				$numd = $numd."Y ".(unidad($numdero - 80));
		}
		else if ($numdero >= 70 && $numdero <= 79)
		{
			$numd = "SETENTA ";
			if ($numdero > 70)
				$numd = $numd."Y ".(unidad($numdero - 70));
		}
		else if ($numdero >= 60 && $numdero <= 69)
		{
			$numd = "SESENTA ";
			if ($numdero > 60)
				$numd = $numd."Y ".(unidad($numdero - 60));
		}
		else if ($numdero >= 50 && $numdero <= 59)
		{
			$numd = "CINCUENTA ";
			if ($numdero > 50)
				$numd = $numd."Y ".(unidad($numdero - 50));
		}
		else if ($numdero >= 40 && $numdero <= 49)
		{
			$numd = "CUARENTA ";
			if ($numdero > 40)
				$numd = $numd."Y ".(unidad($numdero - 40));
		}
		else if ($numdero >= 30 && $numdero <= 39)
		{
			$numd = "TREINTA ";
			if ($numdero > 30)
				$numd = $numd."Y ".(unidad($numdero - 30));
		}
		else if ($numdero >= 20 && $numdero <= 29)
		{
			if ($numdero == 20)
				$numd = "VEINTE";
			else
				$numd = "VEINTI".(unidad($numdero - 20));
		}
		else if ($numdero >= 10 && $numdero <= 19)
		{
			switch ($numdero){
			case 10:
			{
				$numd = "DIEZ";
				break;
			}
			case 11:
			{		 		
				$numd = "ONCE";
				break;
			}
			case 12:
			{
				$numd = "DOCE";
				break;
			}
			case 13:
			{
				$numd = "TRECE";
				break;
			}
			case 14:
			{
				$numd = "CATORCE";
				break;
			}
			case 15:
			{
				$numd = "QUINCE";
				break;
			}
			case 16:
			{
				$numd = "DIECISEIS";
				break;
			}
			case 17:
			{
				$numd = "DIECISIETE";
				break;
			}
			case 18:
			{
				$numd = "DIECIOCHO";
				break;
			}
			case 19:
			{
				$numd = "DIECINUEVE";
				break;
			}
			}	
		}
		else
			$numd = unidad($numdero);
	return $numd;
}

function centena($numc){
		if ($numc >= 100)
		{
			$numce = "CIEN";
		}
		else
			$numce = decena($numc);
		
		return $numce;	
}
					
function convertir($numero){
		$numf = centena($numero);
	return $numf;
}
?>