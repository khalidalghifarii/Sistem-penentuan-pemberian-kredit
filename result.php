<?php
require_once 'db_connect.php';
require_once 'credit_scoring.php';

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $name = $_GET['name'];
  $age = intval($_GET['age']);
  $maritalStatus = $_GET['maritalStatus'];
  $dependents = intval($_GET['dependents']);
  $occupation = $_GET['occupation'];
  $collateral = $_GET['collateral'];
  $income = floatval(str_replace('.', '', $_GET['income']));
  $loanAmount = floatval($_GET['loanAmount']);

  $score = calculateCreditScore($age, $maritalStatus, $dependents, $occupation, $collateral, $income, $loanAmount);
  $decision = getCreditDecision($score);

  try {
    $stmt = $pdo->prepare("INSERT INTO applicants (name, age, marital_status, dependents, occupation, collateral, income, loan_amount, score, decision) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([$name, $age, $maritalStatus, $dependents, $occupation, $collateral, $income, $loanAmount, $score, $decision]);
  } catch (PDOException $e) {
    die("Database error: " . $e->getMessage());
  }
} else {
  header("Location: index.html");
  exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <title>Global</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="description" content="HTML5 website template">
  <meta name="keywords" content="global, template, html, sass, jquery">
  <meta name="author" content="Bucky Maler">
  <link rel="stylesheet" href="assets/css/main.css">
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Lilita+One&display=swap');

    .lilita-one-regular {
      font-family: "Lilita One", sans-serif;
      font-weight: 400;
      font-style: normal;
    }

    .lilita-one-regular1 {
      font-family: "Lilita One", sans-serif;
      font-weight: 400;
      font-style: normal;
    }
  </style>
  <style>
    :root {
      --primary-color: #0071e3;
      --secondary-color: #86868b;
      --card-background: rgba(255, 255, 255, 0.9);
    }


    .flex-wrapper {
      display: flex;
      justify-content: space-between;
      align-items: center;
      max-width: 1200px;
      margin: 50px auto;
      padding: 0 20px;
    }

    h1.lilita-one-regular {
      font-size: 3vw;
      /* Ukuran teks responsif */
      font-weight: 700;
      text-align: left;
      /* Mengatur teks agar rata kiri */
      margin-bottom: 300px;
      margin-left: -200px;
      /* Geser teks ke kiri */
      color: var(--primary-color);
    }

    h1.lilita-one-regular1 {
      font-size: 3vw;
      /* Ukuran teks responsif */
      font-weight: 700;
      text-align: left;
      /* Mengatur teks agar rata kiri */
      margin-bottom: 300px;

      color: var(--primary-color);
    }


    @media (max-width: 600px) {
      h1.lilita-one-regular {
        text-align: left;
        /* Tetap rata kiri pada layar kecil */
        font-size: 24px;
        /* Ukuran teks lebih kecil untuk perangkat kecil */
        margin-left: 10px;
        /* Sesuaikan margin kiri untuk layar kecil */
      }
    }


    p {
      font-size: 20px;
      font-weight: 700;
      text-align: left;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 24px;

    }

    .container1 {
      max-width: 100%;
      /* Memastikan kontainer dapat melebar hingga 100% */
      margin: 0 auto;
      /* Tengah secara horizontal */
      padding: 20px;
      /* Menambah padding dalam kontainer */
      display: flex;
      flex-direction: column;
      /* Mengatur flex agar item berada dalam kolom */
      align-items: stretch;
      /* Membuat elemen di dalam kontainer meluas */
      font-size: 20px;
    }

    .card {
      flex: 1;
      /* Mengizinkan kartu untuk mengisi ruang yang tersedia */
      margin: 10px;
      /* Margin antar kartu */
      padding: 60px;
      /* Padding di dalam kartu */
      border: 1px solid #ccc;
      /* Garis batas untuk kartu */
      border-radius: 8px;
      /* Sudut melingkar */
      width: 100%;
      /* Kartu akan mengambil lebar penuh dari kontainer */
      max-width: 800px;
      /* Atur lebar maksimum kartu menjadi 800px */
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), 0 0 20px rgba(255, 255, 255, 0.6);
      /* Bayangan berwarna putih bersinar */
      font-size: 20px;
    }

    .card1 {
      flex: 1;
      /* Mengizinkan kartu untuk mengisi ruang yang tersedia */
      margin: 10px;
      /* Margin antar kartu */
      padding: 80px;
      /* Padding di dalam kartu */
      border: 1px solid #ccc;
      /* Garis batas untuk kartu */
      border-radius: 8px;
      /* Sudut melingkar */
      width: 100%;
      /* Kartu akan mengambil lebar penuh dari kontainer */
      max-width: 800px;
      /* Atur lebar maksimum kartu menjadi 800px */
      font-size: 25px;
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1), 0 0 20px rgba(255, 255, 255, 0.6);
      /* Bayangan berwarna putih bersinar */
      margin-top: -200px;
    }

    /* Mengatur label agar lebih panjang */
    .label {
      width: 100%;
      /* Membuat label menjadi lebar 100% */
      font-size: 1.2em;
      /* Ukuran font untuk label */
      text-align: left;
      /* Rata kiri untuk label */
    }

    @media (max-width: 768px) {
      .card {
        width: 100%;
        /* Kartu akan mengambil lebar penuh pada layar kecil */
        max-width: 100%;
        /* Menghilangkan batas maksimum pada layar kecil */
      }
    }



    input[type="text"],
    input[type="number"],
    select {
      width: 100%;
      padding: 12px 16px;
      border: 1px solid #d2d2d7;
      border-radius: 8px;
      font-size: 16px;
      transition: border-color 0.3s ease;
    }

    input[type="text"]:focus,
    input[type="number"]:focus,
    select:focus {
      outline: none;
      border-color: var(--primary-color);
      box-shadow: 0 0 10px rgba(173, 216, 230, 0.8);
    }

    button {
      background-color: var(--primary-color);
      color: white;
      border: none;
      border-radius: 8px;
      padding: 16px 32px;
      font-size: 18px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.3s ease;
      width: 100%;
    }

    button:hover {
      background-color: #0051a5;
    }

    @media (max-width: 600px) {
      .flex-wrapper {
        flex-direction: column;
        align-items: center;
      }

      .container1 {
        margin-left: 0;
        padding: 0 16px;
      }

      h1 {
        text-align: center;
        font-size: 36px;
      }
    }

    .typing-text {
      font-size: 20px;
      font-weight: 700;
      text-align: center;
      color: white;
      margin-top: 50px;
      margin-bottom: 20px;
      white-space: nowrap;
      overflow: hidden;
      border-right: 2px solid white;
      animation: typing 3.5s steps(40, end), blink 0.75s step-end infinite;
    }

    @keyframes typing {
      from {
        width: 0;
      }

      to {
        width: 100%;
      }
    }

    @keyframes blink {
      50% {
        border-color: transparent;
      }
    }
  </style>
</head>

<body>

  <!-- notification for small viewports and landscape oriented smartphones -->
  <div class="device-notification">
    <a class="device-notification--logo" href="#0">
      <img src="assets/img/logo.png" alt="Global">
      <p>KREDITRUST</p>
    </a>
    <p class="device-notification--message">Global has so much to offer that we must request you orient your device to portrait or find a larger screen. You won't be disappointed.</p>
  </div>

  <div class="perspective effect-rotate-left">
    <div class="container">
      <div class="outer-nav--return"></div>
      <div id="viewport" class="l-viewport">
        <div class="l-wrapper">
          <header class="header">
            <a class="header--logo" href="#0">
              <img src="assets/img/logo.png" alt="Global">
              <p>KREDITRUST</p>
            </a>

            <div class="header--nav-toggle">
              <span></span>
            </div>


          </header>
          <ul class="l-main-content main-content">
            <li class="l-section section section--is-active">
              <div class="intro">
                <div class="flex-wrapper">
                  <div class="container1 py-5">
                    <div class="output" id="output">
                      <h1 class="cursor"></h1>
                      <p></p>
                    </div>
                  </div>
                  <div>
                    <h1 class="lilita-one-regular font-bold">Sistem Penentuan <br> Pemberian Kredit</h1>
                  </div>
                  <div class="container1">
                    <div class="card shadow-md">
                      <form id="creditForm" action="process.php" method="POST">
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="name">Nama</label>
                          <input type="text" id="name" name="name" required>
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="age">Usia</label>
                          <input type="number" id="age" name="age" required min="18">
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="maritalStatus">Status Pernikahan</label>
                          <select id="maritalStatus" name="maritalStatus" required>
                            <option value="Belum Menikah">Belum Menikah</option>
                            <option value="Menikah">Menikah</option>
                            <option value="Janda/Duda">Janda/Duda</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="dependents">Jumlah Tanggungan</label>
                          <input type="number" id="dependents" name="dependents" required min="0">
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="occupation">Pekerjaan</label>
                          <select id="occupation" name="occupation" required>
                            <option value="Tidak Bekerja">Tidak Bekerja</option>
                            <option value="PNS">PNS</option>
                            <!-- Add more options here -->
                          </select>
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="collateral">Jaminan</label>
                          <select id="collateral" name="collateral" required>
                            <option value="Tidak ada">Tidak ada</option>
                            <option value="Rumah">Rumah</option>
                            <option value="Mobil">Mobil</option>
                            <option value="Sepeda motor">Sepeda motor</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="income">Penghasilan per Bulan (Rp)</label>
                          <input type="text" id="income" name="income" required>
                        </div>
                        <div class="form-group">
                          <label style="font-weight: bold; color: white;" for="loanAmount">Jumlah Pinjaman (Rp)</label>
                          <select id="loanAmount" name="loanAmount" required>
                            <option value="5000000">5.000.000</option>
                            <option value="10000000">10.000.000</option>
                            <option value="15000000">15.000.000</option>
                            <option value="20000000">20.000.000</option>
                            <option value="25000000">25.000.000</option>
                            <option value="30000000">30.000.000</option>
                            <option value="35000000">35.000.000</option>
                            <option value="40000000">40.000.000</option>
                            <option value="45000000">45.000.000</option>
                            <option value="50000000">50.000.000</option>
                          </select>
                        </div>
                        <button type="submit">Hitung Skor Kredit</button>
                      </form>
                    </div>
                  </div>
                </div>

                <div class="typing-text" id="typingText"></div>


                <div class="intro--options">
                </div>
              </div>
            </li>

            <li class="l-section section">
              <div class="work">
                <div class="container3">
                  <div class="texth1">

                  </div>
                  <h1 style="  display: flex; justify-content: center; align-items: center;  " class="lilita-one-regular1 font-bold">Hasil Penilaian Kredit</h1>
                  <div class="card1">
                    <div class="card-body">
                      <h2 style="color: white;" class="lilita-one-regular card-title">Skor Kredit: <?php echo $score; ?></h2>
                      <h3 style="color: white;" class="lilita-one-regular  card-title mb-2 text-muted">Keputusan: <?php echo $decision; ?></h3>
                      <table style="color: white;" class="table table-bordered mt-9">
                        <tbody>
                          <tr>
                            <th>Nama :</th>
                            <td style="transform: translate(200px);"><?php echo htmlspecialchars($name); ?></td>
                          </tr>
                          <tr>
                            <th>Usia :</th>
                            <td style="transform: translate(200px);"><?php echo $age; ?> tahun</td>
                          </tr>
                          <tr>
                            <th>Status Pernikahan :</th>
                            <td style="transform: translate(200px);"><?php echo $maritalStatus; ?></td>
                          </tr>
                          <tr>
                            <th>Jumlah Tanggungan :</th>
                            <td style="transform: translate(200px);"><?php echo $dependents; ?></td>
                          </tr>
                          <tr>
                            <th>Pekerjaan :</th>
                            <td style="transform: translate(200px);"><?php echo $occupation; ?></td>
                          </tr>
                          <tr>
                            <th>Jaminan :</th>
                            <td style="transform: translate(200px);"><?php echo $collateral; ?></td>
                          </tr>
                          <tr>
                            <th>Penghasilan per Bulan :</th>
                            <td style="transform: translate(200px);">Rp <?php echo number_format($income, 0, ',', '.'); ?></td>
                          </tr>
                          <tr>
                            <th>Jumlah Pinjaman :</th>
                            <td style="transform: translate(200px);">Rp <?php echo number_format($loanAmount, 0, ',', '.'); ?></td>
                          </tr>
                        </tbody>
                      </table>
                      <a href="index.html" class="btn btn-primary">Kembali ke Formulir</a>
                    </div>
                  </div>
                </div>
              </div>
            </li>



            <li class="l-section section">
              <div class="about">
                <h1 style="margin-left: 300px;" class="lilita-one-regular1">Tim Kami</h1>
                <div class="work--lockup">
                  <ul class="slider">
                    <li class="slider--item slider--item-left">
                      <a href="#0">
                        <div class="slider--item-image">
                          <img src="assets\img\zahra.jpeg" alt="Victory">
                        </div>
                        <p class="slider--item-title">Zahra <br> Zafira</p>
                      </a>
                    </li>
                    <li class="slider--item slider--item-center">
                      <a href="#0">
                        <div class="slider--item-image">
                          <img src="assets\img\kairi.jpeg" alt="Metiew and Smith">
                        </div>
                        <p class="slider--item-title">Muhammad Raza Adzani <br> 2208107010066</p>
                      </a>
                    </li>
                    <li class="slider--item slider--item-left">
                      <a href="#0">
                        <div class="slider--item-image">
                          <img src="assets\img\alghi1.PNG" alt="Victory">
                        </div>
                        <p class="slider--item-title">Khalid Alghifari <br> 2208107010044</p>
                      </a>
                    </li>
                    <li class="slider--item slider--item-right">
                      <a href="#0">
                        <div class="slider--item-image">
                          <img src="assets\img\jamrija.jpeg" alt="Alex Nowak">
                        </div>
                        <p class="slider--item-title">Alfi Zamriza <br> 2208107010080</p>
                      </a>
                    </li>
                  </ul>
                  <div class="slider--prev">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                      viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                      <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                        <path d="M561,1169C525,1155,10,640,3,612c-3-13,1-36,8-52c8-15,134-145,281-289C527,41,562,10,590,10c22,0,41,9,61,29
                    c55,55,49,64-163,278L296,510h575c564,0,576,0,597,20c46,43,37,109-18,137c-19,10-159,13-590,13l-565,1l182,180
                    c101,99,187,188,193,199c16,30,12,57-12,84C631,1174,595,1183,561,1169z" />
                      </g>
                    </svg>
                  </div>
                  <div class="slider--next">
                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 150 118" style="enable-background:new 0 0 150 118;" xml:space="preserve">
                      <g transform="translate(0.000000,118.000000) scale(0.100000,-0.100000)">
                        <path d="M870,1167c-34-17-55-57-46-90c3-15,81-100,194-211l187-185l-565-1c-431,0-571-3-590-13c-55-28-64-94-18-137c21-20,33-20,597-20h575l-192-193C800,103,794,94,849,39c20-20,39-29,61-29c28,0,63,30,298,262c147,144,272,271,279,282c30,51,23,60-219,304C947,1180,926,1196,870,1167z" />
                      </g>
                    </svg>
                  </div>
                </div>
              </div>
            </li>
            <li class="l-section section">
              <div class="contact">
                <div class="contact--lockup">
                  <div class="modal">
                    <div class="modal--information">
                      <p>Banda Aceh</p>
                      <a href="mailto:ouremail@gmail.com">jamrijamustopa@gmail.com</a>
                      <a href="tel:+148126287560">+62 12 628 75 60</a>
                    </div>
                    <ul class="modal--options">

                      <li><a href="mailto:jamrijamustopa@gmail.com">Hubungi Kami</a></li>
                    </ul>
                  </div>
                </div>
              </div>
            </li>
            <li class="l-section section">
              <div class="hire">
                <h2>You want us to do</h2>
                <!-- checkout formspree.io for easy form setup -->
                <form class="work-request">
                  <div class="work-request--options">
                    <span class="options-a">
                      <input id="opt-1" type="checkbox" value="app design">
                      <label for="opt-1">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        App Design
                      </label>
                      <input id="opt-2" type="checkbox" value="graphic design">
                      <label for="opt-2">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        Graphic Design
                      </label>
                      <input id="opt-3" type="checkbox" value="motion design">
                      <label for="opt-3">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        Motion Design
                      </label>
                    </span>
                    <span class="options-b">
                      <input id="opt-4" type="checkbox" value="ux design">
                      <label for="opt-4">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        UX Design
                      </label>
                      <input id="opt-5" type="checkbox" value="webdesign">
                      <label for="opt-5">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        Webdesign
                      </label>
                      <input id="opt-6" type="checkbox" value="marketing">
                      <label for="opt-6">
                        <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                          viewBox="0 0 150 111" style="enable-background:new 0 0 150 111;" xml:space="preserve">
                          <g transform="translate(0.000000,111.000000) scale(0.100000,-0.100000)">
                            <path d="M950,705L555,310L360,505C253,612,160,700,155,700c-6,0-44-34-85-75l-75-75l278-278L550-5l475,475c261,261,475,480,475,485c0,13-132,145-145,145C1349,1100,1167,922,950,705z" />
                          </g>
                        </svg>
                        Marketing
                      </label>
                    </span>
                  </div>
                  <div class="work-request--information">
                    <div class="information-name">
                      <input id="name" type="text" spellcheck="false">
                      <label for="name">Name</label>
                    </div>
                    <div class="information-email">
                      <input id="email" type="email" spellcheck="false">
                      <label for="email">Email</label>
                    </div>
                  </div>
                  <input type="submit" value="Send Request">
                </form>
              </div>
            </li>
          </ul>
        </div>
      </div>
    </div>
    <ul class="outer-nav" style="color: white;">
      <li class="is-active">Beranda</li>
      <li>Hasil</li>
      <li>Tentang</li>
      <li>Hubungi Kami</li>
    </ul>
  </div>

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
  <script>
    window.jQuery || document.write('<script src="assets/js/vendor/jquery-2.2.4.min.js"><\/script>')
  </script>
  <script src="assets/js/functions-min.js"></script>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
  <script>
    $(document).ready(function() {
      $('#income').mask('000.000.000', {
        reverse: true
      });

      $('#creditForm').on('submit', function(e) {
        e.preventDefault();
        var formData = $(this).serialize();
        window.location.href = 'result.php?' + formData;
      });

      var text = "Hasil Penentuan Pemberian Kredit dapat dilihat pada halaman Hasil.";

      $('#typingText').text(text);
    });
  </script>

</body>

</html>