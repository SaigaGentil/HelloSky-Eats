 case 'edithotel':
 if(empty($_POST['hotel_id']) || !is_numeric($_POST['hotel_id']) || $_POST['hotel_id'] < 1) {
 die();
 }
 $id = $_POST['hotel_id'];
 $name = $_POST['hotel_name'];
 $desc = $_POST['hotel_desc'];
 $stars = $_POST['hotel_stars'];
 $phone = $_POST['hotel_phone'];
 $email = $_POST['hotel_email'];
 $website = $_POST['hotel_website'];
 $street = $_POST['hotel_street'];
 $street_no = $_POST['hotel_street_no'];
 $postcode = $_POST['hotel_postcode'];
 $city = $_POST['hotel_city'];

 $data = array(
 "HOTEL_NAME" => $name,
 "HOTEL_DESCRIPTION" => $desc,
 "HOTEL_STARS" => $stars,
 "HOTEL_PHONE" => $phone,
 "HOTEL_EMAIL" => $email,
 "HOTEL_WEBSITE" => $website,
 "HOTEL_STREET" => $street,
 "HOTEL_STREET_NO" => $street_no,
 "HOTEL_POSTCODE" => $postcode,
 "HOTEL_CITY" => $city
 );

 $where['HOTEL_ID'] = '='.$id;

 $database = new Database();
 $database->updateRows("HOTEL", $data, $where);

 header('Location: index.php');
 break;