<?php
@session_start();

@ob_start();

function __autoload($name)
{
    include('classes/_class.' . $name . '.php');
}

$config = new config;

$db = new db($config->DBhost, $config->DBuser, $config->DBpass, $config->DBname);


if (isset($_POST['image'])) {
    $text = $_POST['text'];
    $price = $_POST['price'];
    $category = $_POST['category'];
    $phone = $_POST['phone'];
    $datetime = time();
    $datet = date('d-m-y', time());

    $photo = '/img/noimg.jpg';

    $db->query("INSERT INTO announce (`cat_id`, `date`, `price`, `phone`, `text`, `delcode`, `photo`) VALUES ('$category', '$datetime', '$price', '$phone', '$text', '$datetime', '$photo')");
?>

    Успешно добавлено
    <script>
        location.reload();
    </script>
    <?php
} else {

    if (isset($_POST['my_file_upload'])) {
        $text = $_POST['text'];
        $price = $_POST['price'];
        $category = $_POST['category'];
        $phone = $_POST['phone'];
        $datetime = time();

        $datet = date('d-m-y', time());

        $root = $_SERVER['DOCUMENT_ROOT'];

        $uploaddir = $root . '/announce/' . $datet . '';
        $uploaddir2 = '/announce/' . $datet . '';


        if (!is_dir($uploaddir)) mkdir($uploaddir, 0777);

        $files      = $_FILES;
        $done_files = array();

        foreach ($files as $file) {
            $file_name = cyrillic_translit($file['name']);

            if (move_uploaded_file($file['tmp_name'], "$uploaddir/$file_name")) {
                $done_files[] = realpath("$uploaddir/$file_name");
            }
        }

        $db->query("INSERT INTO announce (`cat_id`, `date`, `price`, `phone`, `text`, `delcode`, `photo`) VALUES ('$category', '$datetime', '$price', '$phone', '$text', '$datetime', '$uploaddir2/$file_name')");

        $code = $datetime;

        $message = 'Код для удаления Вашего объявления 1ns.kz: ' . $code;

        file_get_contents("https://smsc.kz/sys/send.php?login=highsystem&psw=Brat5234305&phones=$phone&mes=$message");
    ?>
        Успешно добавлено
        <script>
            location.reload();
        </script>
<?php



    }
}


## Транслитирация кирилических символов
function cyrillic_translit($title)
{
    $iso9_table = array(
        'А' => 'A', 'Б' => 'B', 'В' => 'V', 'Г' => 'G', 'Ѓ' => 'G',
        'Ґ' => 'G', 'Д' => 'D', 'Е' => 'E', 'Ё' => 'YO', 'Є' => 'YE',
        'Ж' => 'ZH', 'З' => 'Z', 'Ѕ' => 'Z', 'И' => 'I', 'Й' => 'J',
        'Ј' => 'J', 'І' => 'I', 'Ї' => 'YI', 'К' => 'K', 'Ќ' => 'K',
        'Л' => 'L', 'Љ' => 'L', 'М' => 'M', 'Н' => 'N', 'Њ' => 'N',
        'О' => 'O', 'П' => 'P', 'Р' => 'R', 'С' => 'S', 'Т' => 'T',
        'У' => 'U', 'Ў' => 'U', 'Ф' => 'F', 'Х' => 'H', 'Ц' => 'TS',
        'Ч' => 'CH', 'Џ' => 'DH', 'Ш' => 'SH', 'Щ' => 'SHH', 'Ъ' => '',
        'Ы' => 'Y', 'Ь' => '', 'Э' => 'E', 'Ю' => 'YU', 'Я' => 'YA',
        'а' => 'a', 'б' => 'b', 'в' => 'v', 'г' => 'g', 'ѓ' => 'g',
        'ґ' => 'g', 'д' => 'd', 'е' => 'e', 'ё' => 'yo', 'є' => 'ye',
        'ж' => 'zh', 'з' => 'z', 'ѕ' => 'z', 'и' => 'i', 'й' => 'j',
        'ј' => 'j', 'і' => 'i', 'ї' => 'yi', 'к' => 'k', 'ќ' => 'k',
        'л' => 'l', 'љ' => 'l', 'м' => 'm', 'н' => 'n', 'њ' => 'n',
        'о' => 'o', 'п' => 'p', 'р' => 'r', 'с' => 's', 'т' => 't',
        'у' => 'u', 'ў' => 'u', 'ф' => 'f', 'х' => 'h', 'ц' => 'ts',
        'ч' => 'ch', 'џ' => 'dh', 'ш' => 'sh', 'щ' => 'shh', 'ъ' => '',
        'ы' => 'y', 'ь' => '', 'э' => 'e', 'ю' => 'yu', 'я' => 'ya'
    );

    $name = strtr($title, $iso9_table);
    $name = preg_replace('~[^A-Za-z0-9\'_\-\.]~', '-', $name);
    $name = preg_replace('~\-+~', '-', $name); // --- на -
    $name = preg_replace('~^-+|-+$~', '', $name); // кил - на концах

    return $name;
}
