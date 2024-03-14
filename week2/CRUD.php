<?php
include "sqli.php"; // Include the file containing database connection details

// Tạo query
$query_all_players = 'SELECT Player.id, Player.shirt_number, Position.name AS position, Nation.name AS national, Player.name, Player.height, Player.footed 
          FROM Player
          INNER JOIN Position ON Player.position_id = Position.id
          INNER JOIN Nation ON Player.nation_id = Nation.id';
// Xử lý query
$result = $conn->query($query_all_players); // Sử dụng biến $conn thay vì $mysqli

// Check lỗi
if (!$result) {
   echo 'Lỗi truy vấn: ' . $conn->error; // Sử dụng $conn->error thay vì $mysqli->error
   die();
}
//Get nation
$query_all_nation = 'SELECT * FROM arsenalsquad.nation;';

$result_nation = $conn->query($query_all_nation); // Sử dụng biến $conn thay vì $mysqli

if (!$result_nation) {
    echo 'Lỗi truy vấn: ' . $conn->error; // Sử dụng $conn->error thay vì $mysqli->error
    die();
 }

//Get position
$query_all_position = 'SELECT * FROM arsenalsquad.position;';

$result_pos = $conn->query($query_all_position); // Sử dụng biến $conn thay vì $mysqli

if (!$result_pos) {
    echo 'Lỗi truy vấn: ' . $conn->error; // Sử dụng $conn->error thay vì $mysqli->error
    die();
 }
//Add Player
//Validate field
    $name_err = $height_err =  $shirt_number_err = '';
    $name = $height = $shirt_number = '';
    if (array_key_exists('name', $_POST)) {
        if ($_POST['name'] == '') {
            $name_err = 'Name required';
        } else {
            $name = $_POST['name'];
        }
    }

    if (array_key_exists('shirt_number', $_POST)) {
        if ($_POST['shirt_number'] == '') {
            $shirt_number_err = 'shirt_number required';
        } else {
            $shirt_number = $_POST['shirt_number'];
        }
    }

    if (array_key_exists('height', $_POST)) {
        if ($_POST['height'] == '') {
            $height_err = 'height required';
        } else {
            $height = $_POST['height'];
        }
    }
    if(isset($_POST['nation'])) {
        $nation = $_POST['nation'];
    } else {
        // Xử lý khi không có dữ liệu gửi từ form cho trường "nation"
    }
    
    if(isset($_POST['pos'])) {
        $position = $_POST['pos'];
    } else {
        // Xử lý khi không có dữ liệu gửi từ form cho trường "pos"
    }
    
    if(isset($_POST['footed'])) {
        $footed = $_POST['footed'];
    } else {
        // Xử lý khi không có dữ liệu gửi từ form cho trường "footed"
    }
    
    $query_insert_player = 'INSERT INTO `arsenalsquad`.`player`
                            (`id`,
                            `shirt_number`,
                            `height`,
                            `footed`,
                            `nation_id`,
                            `position_id`,
                            `name`)
                            VALUES
                            (NULL,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?,
                            ?)';
    $stmt = mysqli_prepare($conn, $query_insert_player);

    // Kiểu dữ liệu cho bind_param: 'i' (integer), 'd' (double), 's' (string), 'b' (blob)
    mysqli_stmt_bind_param($stmt, "idssis", $shirt_number, $height, $footed, $nation, $position, $name);

    // Thực thi câu lệnh INSERT
    mysqli_stmt_execute($stmt);

    // Kiểm tra xem câu lệnh đã thực hiện thành công hay không
    if (mysqli_stmt_affected_rows($stmt) > 0) {
        echo "Dữ liệu đã được chèn thành công vào bảng 'player'.";
        // Gọi hàm JavaScript để tải lại trang
        echo '<script>reloadPage();</script>';
    } else {
        echo "Lỗi: " . mysqli_error($conn);
    }



    // Đóng statement
    mysqli_stmt_close($stmt);

// $query_update_player = 'UPDATE `arsenalsquad`.`player`
// SET
// `id` = <{id: }>,
// `shirt_number` = <{shirt_number: }>,
// `height` = <{height: }>,
// `footed` = <{footed: }>,
// `nation_id` = <{nation_id: }>,
// `position_id` = <{position_id: }>,
// `name` = <{name: }>
// WHERE `id` = <{expr}>;';
// $query_delete_player = 'DELETE FROM `arsenalsquad`.`player`
// WHERE <{where_expression}>;
// ';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Arsenal</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-jv0OV8ri5J+plHyYLMUwNfOXNkPNo4hDqCzpbO8Gn3p6ZmJ+2u5oRLDD6v3PbofAnL6PM4F/ZO9IvH6z9CS5TQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <h1>Danh sách cầu thủ Arsenal</h1>
    <a href="#" onclick="openPopup()">Add Player</a>

    <div id="popup" class="popup">
        <h2>Add Player</h2>
        <form method="post">
            <label> Name </label>
            <input type="text" name="name" />
            <label style="color:red"><?php echo $name_err ?></label>
            <br />
            <label> Squad Number </label>
            <input type="text" name="shirt_number" />
            <label style="color:red"><?php echo $shirt_number_err ?></label>
            <br />
            <label> National </label>
            <select name="nation">
                <?php
                while ($row = mysqli_fetch_assoc($result_nation)) {
                    echo
                    '
                        <option value="' . $row["id"] . '">' . $row["name"] . '</option>
                        ';
                }
                ?>

            </select><br />

            <label> Position </label>
            <select name="pos">
                <?php
                while ($row = mysqli_fetch_assoc($result_pos)) {
                    echo
                    '
                        <option value="' . $row["id"] . '">' . $row["name"] . '</option>
                        ';
                }
                ?>

            </select><br />

            <label> Height </label>
            <input type="text" name="height" />
            <label style="color:red"><?php echo $height_err ?></label>
            
            <div class="checkbox-container">
            <label> Footed </label>
            <input type="radio" name="footed" value="right" id="right"/>
            <label for="right">Right</label>
            <input type="radio" name="footed" value="left" id="left"/>
            <label for="left">Left</label>
            <input type="radio" name="footed" value="both" id="both"/>
            <label for="both">Both</label>
            </div>
            <input type="submit" value="Add new player" />
        </form>
        <button onclick="closePopup()">Close</button>
    </div>

    <table border="1px solid">
        <thead> <!-- Tiêu đề -->
            <tr>
                <th>ID</th>
                <th>Squad number</th>
                <th>Position</th>
                <th>National</th>
                <th>Fullname</th>
                <th>Height</th>
                <th>Footed</th>
                <th></th>
                <th></th>
                <th></th>
            </tr>
        </thead>
        <tbody> <!-- Hiển thị các bản ghi -->
            <?php
            while ($row = $result->fetch_assoc()) {
                echo 
                '
                <tr>
                    <td>'.$row["id"] .'</td>
                    <td>'.$row["shirt_number"].'</td>
                    <td>'.$row["position"].'</td>
                    <td>'.$row["national"].'</td>
                    <td>'.$row["name"].'</td>
                    <td>'.$row["height"].'</td>
                    <td>'.$row["footed"].'</td>
                    <td>
                    <a href="">Detail</a>
                    </td>
                    <td>
                    <a href="">Update</a>
                    </td>
                    <td href="">
                    <a href="">Delete</a>
                    </td>
                </tr>
                ';
            }
            ?>
        </tbody>
    </table>
</body>
<script>
function openPopup() {
  document.getElementById("popup").style.display = "block";
  document.getElementById("overlay").style.display = "block";
}

function closePopup() {
  document.getElementById("popup").style.display = "none";
  document.getElementById("overlay").style.display = "none";
}
// Hàm để tự động load lại trang sau khi thêm dữ liệu
function reloadPage() {
        location.reload();
    }
</script>
<style>
.popup {
  display: none;
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  background-color: #ffffff;
  padding: 20px;
  border: 1px solid #ccc;
  box-shadow: 0 2px 5px rgba(0,0,0,0.5);
  z-index: 9999;
}
.overlay {
  display: none;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background-color: rgba(0,0,0,0.5);
  z-index: 9998;
}
.checkbox-container {
  display: flex;
  flex-direction: row;
}

.checkbox-container input[type="checkbox"] {
  margin-right: 10px; /* Khoảng cách giữa các checkbox */
}
</style>
</head>
<body>
</html>
