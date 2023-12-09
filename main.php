<?php

session_start();

$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';


$type = $_GET['querytypes']
$queryTypes = isset($_GET['querytypes']) ? $_GET['querytypes'] : null;

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

switch ($type) {
    case 'userlogin':
        $email = $_GET['email'];
        $password = $_GET['passord'];   
        $stmt = $conn->query("SELECT * FROM user WHERE user.email = '%$email%'AND user.passord = '%$password%';");

        break;

    case 'userlogin':
        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $password = $_GET['passord'];
        $role = $_GET['role'];

        $stmt = $conn->query("INSERT INTO myTable (firstname, lastname, email, password, role) VALUES ( '%$firstname%','%$lastname%', '%$email%', '%$password%', '%$role%')");

        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }
        break;

    case 'listuser':
        $stmt = $conn->query("SELECT * FROM user WHERE user.email = '%$email%'AND user.passord = '%$password%';");

        break;
    case 'userlogout':
        session_destroy()
    
        break;
    case 'dashboard':
        $select = $_GET('select');
        $type = $_GET('type')

        if ($select == "all"){

            $stmt = $conn->query("SELECT * FROM contacts;");

        } elseif ($type != ""){
            $stmt = $conn->query("SELECT * FROM contacts WHERE contacts.type = '%$type%';");
        }

        elseif ($type != ""){
            $id = $_SESSION['id']
            $stmt = $conn->query("SELECT * FROM contacts WHERE contacts.assigned_to = '%$id%';");
        }
        


    
        break;
    case 'startnewcontact':

        $stmt = $conn->query("SELECT assigned_to FROM contacts;");

    
        break;
    
    case 'newcontact':

        $firstname = $_GET['firstname'];
        $lastname = $_GET['lastname'];
        $email = $_GET['email'];
        $telephone = $_GET['telephone'];
        $company = $_GET['company'];
        $type = $_GET['type'];
        $assigned_to = $_GET['assigned_to'];
        $created_by = $_SESSION['id'];
        $created_at = time();
        $updated_at = time();


        $stmt = $conn->query("INSERT INTO your_table_name (firstname, lastname, email, telephone, company, type, assigned_to, created_by, created_at, updated_at) VALUES ('$firstname', '$lastname', '$email', '$telephone', '$company', '$type', '$assigned_to', '$created_by', '$created_at', '$updated_at');");

    
        if ($stmt->execute()) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $stmt->error;
        }

        break;

    case 'assign':
        $assigned_to = $_SESSION['id'];
        $updated_at = time();
        $email = $_GET('email')
        $stmt = $conn->query("UPDATE contacts SET assigned_to = '%$assigned_to%', updated_at = '%$updated_at%' WHERE   contacts.email = '%$email%'");


        break;

    case 'switch':
        $type = $_GET("type")
        $updated_at = time();
        $email = $_GET('email')
        $stmt = $conn->query("UPDATE contacts SET type = '%$type%', updated_at = '%$$updated_at%' WHERE contacts.email = '%$$email%'");


        break;

    case 'listnote':


        $type = $_GET("type");
        $updated_at = time();
        $email = $_GET('email');
        $stmt = $conn->query("SELECT users.id, users.firstname, users.lastname, orders.order_date, notes.created_by, notes.comment FROM notes JOIN users ON notes.created_by = notes.id JOIN contacts ON notes.product_id = contact_id.product_id WHERE contacts.email = '%$email%'");

        



        break;

    case 'switch':


        break;
    
    default:
        # code...
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
      <td><?= $result['name']; ?></td>
      <td><?= $result['email']; ?></td>
      <td><?= $result['role']; ?></td>
      <td><?= $result['created']; ?></td>
    </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?php else: ?>
<?php endif; ?>


