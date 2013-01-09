<?php echo render('partial.head'); ?>
<?php
$rez = Session::get('result');
if (!isset($rez)) {
    echo Form::open_for_files('upload/upload', 'post');
    echo Form::label('upload', 'Entrez un fichier');
    echo Form::file('upload');
    echo Form::submit('Envoyer');
    echo Form::close();
}
else
{
    if($rez)
    {
        echo "Le script s'est éxécuté correctement";
    }
    else
    {
        echo Session::get('msg');
    }
}
?>

<?php
echo render('partial.foot');