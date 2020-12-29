<?php 
//importando las librerias que usaremos de yii
use yii\helpers\Url; //para covertir o manejar url para rutas
use yii\helpers\Html; // tiene muchas ayudas de etiquetas html
?>

<?php 
print "formulario";
echo "<h4>".$mensaje."</h4>";

echo Html::BeginForm(
    Url::toRoute("site/request"), //va la accion
    "get", //va el metodo http
    ['class'=>"form"] //van las opciones
);
?>

<div class="form-group">
<?= Html::label("nombre1","a ver ")?>
<?= Html::textInput("nombre1",null,array("class"=>"form-control","type"=>"password","placeholder"=>"password"))?>
<?= Html::label("nombre2","a ver ")?>
<?= Html::textInput("nombre2",null,array("class"=>"form-control"))?>
<?= Html::label("nombre3","a ver ")?>
<?= Html::textInput("dato3",null,array("class"=>"form-control"))?>
</div>
<?= Html::submitButton("enviar",["class"=>"btn btn-primary"])?>
<?= Html::EndForm();?>

