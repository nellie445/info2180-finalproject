<?php
     
session_start();

$host = 'localhost';
$username = 'FinalProject_user';
$password = 'password123';
$dbname = 'dolphin_crm';


$type = $_GET['querytypes'];

$queryTypes = isset($_GET['querytypes']) ? $_GET['querytypes'] : null;

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

switch ($type) {
    case "userlogin":
        $email = $_GET['email'];
        $password = $_GET['password'];  
        
        $stmt = $conn->prepare("SELECT * FROM users WHERE users.email = :email AND users.password = :password");
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        if($stmt->execute()){
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            foreach ($results as $result) {
                // Use print_r for debugging, or format output as needed

    
                $_SESSION['id'] = $result['id'];
                $_SESSION['firstname'] = $result['firstname'];
                $_SESSION['lastname'] = $result['lastname'];
                $_SESSION['password'] = $result['password'];
                $_SESSION['email'] = $result['email'];
                $_SESSION['role'] = $result['role'];

                echo "login succeeded";



            }
            
            
        } else{
            echo "login failed";
            
        }

        break;

    case 'adduser':

        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $password = $_GET['password'];
        $role = $_GET['role'];

        $stmt = $conn->prepare("INSERT INTO users (firstname, lastname, email, password, role) VALUES ( '$firstname','$lastname', '$email', '$password', '$role')");

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        break;

    case 'listuser':
        if($_SESSION['role'] == "admin"){
            $stmt = $conn->query("SELECT * FROM users");
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            echo "permission needed";
        }


        foreach ($results as $result) {
            print_r($result);
        }

        break;
    case 'userlogout':

        session_destroy();

        break;
    case 'dashboard':

        $select = $_GET['select'];     

        $types = $_GET['type'];

        if ($select == "all"){

            $stmt = $conn->query("SELECT * FROM contacts;");

        } elseif ($select == "type"){
            $stmt = $conn->query("SELECT * FROM contacts WHERE contacts.type = '$types';");
        }

        elseif ($select == "assigned"){
            $id = $_SESSION['id'];
            $stmt = $conn->query("SELECT * FROM contacts WHERE contacts.assigned_to = '$id';");
        } else {
            echo "No item chosen";
        }


        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);


        foreach ($results as $result) {
            print_r($result);
        }        


    
        break;
    case 'startnewcontact':

       
        $stmt = $conn->query("SELECT firstname , lastname, id FROM users");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
   

        foreach ($results as $result) {
            echo $result['firstname'] . " " . $result['lastname'] . " " . $result['firstname'];
            
            

        }  
   
        break;
    
    case 'newcontact':

        $title = $_GET['title'];
        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $telephone = $_GET['telephone'];
        $company = $_GET['company'];
        $type = $_GET['type'];
        $assigned_to = $_GET['assigned_to'];
        $created_by = $_SESSION['id'];


        echo "Title: $title<br>";
        echo "First Name: $firstname<br>";
        echo "Last Name: $lastname<br>";
        echo "Email: $email<br>";
        echo "Telephone: $telephone<br>";
        echo "Company: $company<br>";
        echo "Type: $type<br>";
        echo "Assigned To: $assigned_to<br>";
        echo "Created By: $created_by<br>";



        $stmt = $conn->prepare("INSERT INTO contacts (title, firstname, lastname, email, telephone, company, type, assigned_to, created_by) VALUES (:title, :firstname, :lastname, :email, :telephone, :company, :type, :assigned_to, :created_by)");

        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':firstname', $firstname);
        $stmt->bindParam(':lastname', $lastname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':telephone', $telephone);
        $stmt->bindParam(':company', $company);
        $stmt->bindParam(':type', $type);
        $stmt->bindParam(':assigned_to', $assigned_to);
        $stmt->bindParam(':created_by', $created_by);


        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        break;

    case 'assign':
        $assigned_to = $_SESSION['id'];
        $updated_at = time();
        $email = $_GET('email');
        $stmt = $conn->query("UPDATE contacts SET assigned_to = '%$assigned_to%', updated_at = '%$updated_at%' WHERE   contacts.email = '%$email%'");


        break;

    case 'switch':
        $type = $_GET("type");
        $updated_at = time();
        $email = $_GET('email');
        $stmt = $conn->query("UPDATE contacts SET type = '%$type%', updated_at = '%$updated_at%' WHERE contacts.email = '%$email%'");


        break;

    case 'getCUsr':

        echo $_SESSION['id']."||".$_SESSION['firstname']."||".$_SESSION['lastname']."||".$_SESSION['password']."||".$_SESSION['email']."||".$_SESSION['role'];
        break;

    case 'listnote':


        $type = $_GET("type");
        $updated_at = time();
        $email = $_GET('email');
        $stmt = $conn->query("SELECT users.id, users.firstname, users.lastname, orders.order_date, notes.created_by, notes.comment FROM notes JOIN users ON notes.created_by = notes.id JOIN contacts ON notes.contact_id = constacts.id WHERE contacts.email = '%$email%';");
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    


        break;

    case 'addnote':
        $id = $_SESSION['id'];
        $created_at = time();    
        $comment = $_GET("comment");
        $userid = $_GET("userid");
        

        $stmt = $conn->query("INSERT INTO notes (firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('$firstname', '$lastname', '$email', '$telephone', '$company', '$type', '$assigned_to', '$created_by', '$created_at', '$updated_at');");
        break;
    
    default:
    echo "default";





        break;

}







?>



<?php if ($type == 'listuser'): ?>
<table>
  <thead>
    <th>Name</th>
    <th>Email</th>
    <th>Role</th>
    <th>Created</th>
  </thead>
  <tbody>
    <?php foreach ($results as $result): ?>
    <tr>
      <td><?= $result['firstname'] . " " . $result['lastname'] ; ?></td>
      <td><?= $result['email']; ?></td>
      <td><?= $result['role']; ?></td>
      <td><?= $result['created_at']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
<?php endif; ?>


