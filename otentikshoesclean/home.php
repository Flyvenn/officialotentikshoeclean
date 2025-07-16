<?php

include 'config.php';
session_start();

// page redirect
$usermail="";
$usermail=$_SESSION['usermail'];
if($usermail == true){

}else{
  header("location: index.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./css/home.css">
    <title>Otentik Shoes Clean</title>
    <!-- boot -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <!-- fontowesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" integrity="sha512-xh6O/CkQoPOWDdYTDqeRdPCVd1SpvCA9XXcUnZS2FmJNp1coAFzvtCN9BmamE+4aHK8yyUHUSCcJHgXloTyT2A==" crossorigin="anonymous" referrerpolicy="no-referrer"/>
    <!-- sweet alert -->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <link rel="stylesheet" href="./admin/css/roombook.css">
    <style>
      #guestdetailpanel{
        display: none;
      }
      #guestdetailpanel .middle{
        height: 450px;
      }
    </style>
</head>

<body>
  <nav>
    <div class="logo">
      <img class="otentiklogo" src="./image/otentikshoesclean.jpg" alt="logo">
      <p>OTENTIK SHOES CLEAN</p>
    </div>
    <ul>
      <li><a href="#firstsection">Home</a></li>
      <li><a href="#secondsection">Services</a></li>
      <li><a href="#thirdsection">Gallery</a></li>
      <li><a href="#contactus">Contact us</a></li>
      <a href="./logout.php"><button class="btn btn-danger">Logout</button></a>
    </ul>
  </nav>

  <section id="firstsection" class="carousel slide carousel_section" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img class="carousel-image" src="./image/cuci1.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/cuci2.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/cuci3.jpg">
        </div>
        <div class="carousel-item">
            <img class="carousel-image" src="./image/cuci4.jpg">
        </div>

        <div class="welcomeline">
          <h1 class="welcometag">Sepatumu kotor?
            Otentik solusinya! #cleanupyourshoes</h1>
        </div>

     <!-- bookbox -->
<div id="guestdetailpanel">
    <form action="" method="POST" class="guestdetailpanelform">
        <div class="head">
            <h3>BOOKING</h3>
            <i class="fa-solid fa-circle-xmark" onclick="closebox()"></i>
        </div>
        <div class="middle">
            <div class="guestinfo">
                <h4>Customer Information</h4>
                <input type="text" name="Name" placeholder="Enter Full Name">
                <input type="email" name="Email" placeholder="Enter Email">
                <input type="text" name="Phone" placeholder="Enter Phone Number">
                <input type="text" name="Location" placeholder="Enter Pickup/Drop-off Location">
            </div>

            <div class="line"></div>

            <div class="reservationinfo">
                <h4>Shoe Cleaning Details</h4>

                <select name="ServiceType" class="selectinput" id="serviceType">
                    <option value selected>Type of Service</option>
                    <option value="Deep Clean">Deep Clean</option>
                    <option value="Fast Clean">Fast Clean</option>
                    <option value="Repaint">Repaint</option>
                    <option value="Bag Treatment">Bag Treatment</option>
                </select>

                <select name="ShoeType" class="selectinput" id="shoeType">
                    <option value selected>Shoe Type</option>
                    <option value="Sneakers">Sneakers</option>
                    <option value="Leather Shoes">Leather Shoes</option>
                    <option value="Sports Shoes">Sports Shoes</option>
                    <option value="Boots">Boots</option>
                    <option value="Other">Other</option>
                </select>

                <textarea name="ShoeCondition" class="selectinput" placeholder="Shoe condition (e.g., heavy stains, torn areas, odor, etc.)"></textarea>

                <div class="datesection">
                    <span>
                        <label for="pickup">Pickup Date</label>
                        <input name="pickup" type="date" id="pickupDate">
                    </span>
                    <span>
                        <label for="return">Estimated Return Date</label>
                        <input name="return" type="date" id="returnDate" readonly>
                    </span>
                </div>

                <div class="pricesection">
                    <label for="price">Estimated Price</label>
                    <input type="text" name="price" id="price" readonly placeholder="Rp 0">
                </div>
            </div>
        </div>
        <div class="footer">
            <button class="btn btn-success" name="guestdetailsubmit">Submit</button>
        </div>
    </form>
</div>

<script>
    const pickupInput = document.getElementById('pickupDate');
    const returnInput = document.getElementById('returnDate');
    const serviceSelect = document.getElementById('serviceType');
    const shoeSelect = document.getElementById('shoeType');
    const priceInput = document.getElementById('price');

    function updateReturnDate() {
        const pickupDate = new Date(pickupInput.value);
        const service = serviceSelect.value;
        let daysToAdd = 0;

        if (!pickupInput.value || !service) return;

        switch (service) {
            case 'Deep Clean':
            case 'Bag Treatment':
                daysToAdd = 5;
                break;
            case 'Fast Clean':
                daysToAdd = 3;
                break;
            case 'Repaint':
                daysToAdd = 7;
                break;
            default:
                daysToAdd = 0;
        }

        const returnDate = new Date(pickupDate);
        returnDate.setDate(pickupDate.getDate() + daysToAdd);

        const formatted = returnDate.toISOString().split('T')[0];
        returnInput.value = formatted;
    }

    function updatePrice() {
        const service = serviceSelect.value;
        const shoe = shoeSelect.value;
        let price = 0;

        if (!service) {
            priceInput.value = "Rp 0";
            return;
        }

        if (service === 'Fast Clean') {
            price = 35000;
        } else if (service === 'Bag Treatment') {
            price = 50000;
        } else if (service === 'Deep Clean') {
            if (shoe === 'Leather Shoes' || shoe === 'Boots') {
                price = 50000;
            } else {
                price = 40000;
            }
        } else if (service === 'Repaint') {
            if (shoe === 'Leather Shoes' || shoe === 'Boots') {
                price = 150000;
            } else {
                price = 120000;
            }
        }

        priceInput.value = "Rp " + price.toLocaleString("id-ID");
    }

    // Event listeners
    pickupInput.addEventListener('change', updateReturnDate);
    serviceSelect.addEventListener('change', () => {
        updateReturnDate();
        updatePrice();
    });
    shoeSelect.addEventListener('change', updatePrice);
</script>

        <!-- ==== room book php ====-->
        <?php       
if (isset($_POST['guestdetailsubmit'])) {
    $name = $_POST['Name'];
    $email = $_POST['Email'];
    $phone = $_POST['Phone'];
    $location = $_POST['Location'];
    $serviceType = $_POST['ServiceType'];
    $shoeType = $_POST['ShoeType'];
    $shoeCondition = $_POST['ShoeCondition'];
    $pickup = $_POST['pickup'];
    $return = $_POST['return'];
    $price = preg_replace("/[^0-9]/", "", $_POST['price']); // Hapus 'Rp' dan titik

    if ($name == "" || $email == "" || $serviceType == "" || $shoeType == "") {
        echo "<script>swal({
            title: 'Please fill all required fields!',
            icon: 'error',
        });</script>";
    } else {
        $sql = "INSERT INTO shoe_booking (
                    name, email, phone, location, 
                    service_type, shoe_type, shoe_condition,
                    pickup_date, return_date, estimated_price
                ) VALUES (
                    '$name', '$email', '$phone', '$location',
                    '$serviceType', '$shoeType', '$shoeCondition',
                    '$pickup', '$return', '$price'
                )";
        
        $result = mysqli_query($conn, $sql);

        if ($result) {
            echo "<script>swal({
                title: 'Booking Successful!',
                icon: 'success',
            });</script>";
        } else {
            echo "<script>swal({
                title: 'Something went wrong!',
                icon: 'error',
            });</script>";
        }
    }
}

            ?>
          </div>

    </div>
  </section>
    
  <section id="secondsection"> 
    <img src="./image/homeanimatebg.svg">
    <div class="ourroom">
      <h1 class="head">≼ Our Services ≽</h1>
      <div class="roomselect">
        <div class="roombox">
          <div class="hotelphoto h1"></div>
          <div class="roomdata">
            <h2>Deep Cleaning</h2>
      
            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h2"></div>
          <div class="roomdata">
            <h2>Fast Cleaning</h2>

            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h3"></div>
          <div class="roomdata">
            <h2>Repaint</h2>

            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
        <div class="roombox">
          <div class="hotelphoto h4"></div>
          <div class="roomdata">
            <h2>Bag Treatment</h2>

            <button class="btn btn-primary bookbtn" onclick="openbookbox()">Book</button>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section id="thirdsection">
    <h1 class="head">≼ Gallery ≽</h1>
    <div class="facility">
      <div class="box">
      </div>
      <div class="box">
      </div>
      <div class="box">
      </div>
      <div class="box">
      </div>
    </div>
  </section>

  <section id="contactus">
<div class="social">
  <a href="https://www.instagram.com/otentikshoesclean.pekayon/" target="_blank" title="Instagram">
    <i class="fa-brands fa-instagram"></i>
  </a>
  <a href="https://wa.me/6287875285968" target="_blank" title="WhatsApp">
    <i class="fa-brands fa-whatsapp"></i>
  </a>
  <a href="https://www.tiktok.com/@otentik.shoesclen?_t=8rqyuKn0J0i&_r=1" target="_blank">
    <i class="fa-brands fa-tiktok"></i>
  </a>
  <a href="https://maps.app.goo.gl/631yvvdxWiQvkwaY7" target="_blank" title="Our Location">
    <i class="fa-solid fa-map-location-dot"></i>
  </a>
</div>

    <div class="createdby">
      <h5>Created by @rizaluthfiansyah</h5>
    </div>
  </section>


<?php
// Section Pembayaran
$sql = "SELECT * FROM shoe_booking WHERE email = '$usermail' AND payment_status = 'unpaid' LIMIT 1";
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $booking_id = $row['id'];
    $total_amount = $row['estimated_price'];
    echo "
    <div class='container mt-5'>
        <h4>Pembayaran Tertunda</h4>
        <p>Booking ID: $booking_id</p>
        <p>Total Pembayaran: Rp " . number_format($total_amount, 0, ',', '.') . "</p>
        <form method='POST' action='' enctype='multipart/form-data'>
            <input type='hidden' name='booking_id' value='$booking_id'>
            <div class='form-group'>
                <label for='payment_method'>Metode Pembayaran</label>
                <select name='payment_method' class='form-control' required>
                    <option value='Transfer Bank'>Transfer Bank (Bank Mandiri - 1330023458854)</option>
                    <option value='DANA'>DANA - +62 812-8492-5173</option>
                </select>
            </div>
            <div class='form-group mt-3'>
                <label for='payment_proof'>Upload Bukti Pembayaran (foto)</label>
                <input type='file' name='payment_proof' class='form-control' accept='image/*' required>
            </div>
            <button type='submit' name='pay_now' class='btn btn-success mt-3'>Bayar Sekarang</button>
        </form>
    </div>
    ";
}
?>

<script>
    var bookbox = document.getElementById("guestdetailpanel");

    openbookbox = () => {
        bookbox.style.display = "flex";
    }
    closebox = () => {
        bookbox.style.display = "none";
    }
</script>

<?php
// Proses Pembayaran
if (isset($_POST['pay_now'])) {
    $booking_id = $_POST['booking_id'];
    $payment_method = $_POST['payment_method'];

    // Folder upload
    $target_dir = "uploads/";
    $proof_name = basename($_FILES["payment_proof"]["name"]);
    $target_file = $target_dir . time() . "_" . $proof_name;

    // Validasi dan upload file
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];

    if (in_array($imageFileType, $allowed_types)) {
        if (move_uploaded_file($_FILES["payment_proof"]["tmp_name"], $target_file)) {
            // Simpan ke database
            $update = "UPDATE shoe_booking SET payment_status = 'paid', payment_method = '$payment_method', payment_proof = '$target_file' WHERE id = '$booking_id'";
            if (mysqli_query($conn, $update)) {
                echo "<script>swal('Sukses!', 'Pembayaran berhasil!', 'success').then(() => { window.location.href = 'home.php'; });</script>";
            } else {
                echo "<script>swal('Error!', 'Gagal menyimpan ke database.', 'error');</script>";
            }
        } else {
            echo "<script>swal('Error!', 'Gagal mengunggah foto bukti pembayaran.', 'error');</script>";
        }
    } else {
        echo "<script>swal('Error!', 'Jenis file tidak didukung. Harus JPG, PNG, atau GIF.', 'error');</script>";
    }
}
?>

</html>