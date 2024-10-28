<?php
include '../encryption/rc4.php';

// Inisialisasi variabel
$plaintext = isset($_POST['plaintext']) ? $_POST['plaintext'] : '';
$key = isset($_POST['key']) ? $_POST['key'] : '';
$encodedCipher = '';

// Proses enkripsi jika tombol Encrypt ditekan
// Proses enkripsi jika tombol 'Encrypt' diklik
if (isset($_POST['btn-encrypt'])) {
  $plaintext = $_POST['plaintext'];
  $key = $_POST['key'];
  if (!empty($plaintext) && !empty($key)) {
      $ciphertext = rc4($plaintext, $key); // Enkripsi
      $encodedCipher = bin2hex($ciphertext); // Ubah output ke format hex untuk ditampilkan
  } else {
      $encodedCipher = 'Plaintext & Key is required';
  }
}

// Reset field jika tombol Clear ditekan
if (isset($_POST['btn-reset'])) {
    $plaintext = '';
    $key = '';
    $encodedCipher = '';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="apple-touch-icon" sizes="180x180" href="../assets/icon/apple-touch-icon.png" />
  <link rel="icon" type="image/png" sizes="32x32" href="../assets/icon/favicon-32x32.png" />
  <link rel="icon" type="image/png" sizes="16x16" href="../assets/icon/favicon-16x16.png" />
  <link rel="manifest" href="../assets/icon/site.webmanifest" />
  <title>Rivest Cipher 4</title>
  <link href="https://fonts.googleapis.com/css?family=Inconsolata:400,700|VT323" rel="stylesheet">
  <link rel="stylesheet" href="../assets/css/styles.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/prism/1.22.0/themes/prism-tomorrow.min.css">
</head>

<body>
  <header>
    <h1>Encrypt-It!</h1>
    <h2>Translate any text message into a secret.</h2>
    <span class="btngroup">
      <button class="btngroup--btn" onclick="window.location='../index.html';">Home</button>
      <button class="btngroup--btn">Encrypt Text</button>
      <button class="btngroup--btn" onclick="window.location='decrypt_view.php';">Decrypt Text</button>
    </span>
  </header>

  <main>
    <form action="" method="post">
      <fieldset>
        <legend>Text to Encrypt</legend>
        <textarea id="input-text" name="plaintext" rows="10" cols="60" placeholder="Enter your message to encrypt here"><?= htmlspecialchars($plaintext) ?></textarea>
      </fieldset>
      <fieldset>
        <legend>Key</legend>
        <input type="text" name="key" placeholder="Enter your key here" value="<?= htmlspecialchars($key) ?>"></input>
      </fieldset>
      <fieldset>
        <legend>Encrypt Options</legend>
        <p>
          <strong>Cipher Type: </strong>
          <select id="cipher-type">
            <option value="rc4">RC4</option>
            <option value="other" disabled>not available</option>
          </select>
        </p>
        <hr>
        <input type="submit" name="btn-encrypt" value="Encrypt It!" style="display: inline-block;width: 100%; background-color: yellow;"></input>
        <hr>
        <input type="submit" name="btn-reset" value="Clear" style="background-color: brown;color: white;float: right;"></input>
      </fieldset>
    </form>

    <div id="result-area">
      <h2>Result:</h2>
      <p>Result after encrypted..</p>
      <pre><code class="language-html"><?= htmlspecialchars($encodedCipher != '' ? $encodedCipher : 'No text encrypted') ?></code></pre>
    </div>
  </main>

  <div class="animation">
    <script src="https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js"></script>
    <lottie-player src="https://assets10.lottiefiles.com/packages/lf20_Ns4TLz.json" background="transparent" speed="1" style="width: 600px; height: 600px;" loop autoplay></lottie-player>
  </div>

  <script src="../assets/js/scripts.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prism/1.26.0/prism.min.js"></script>
</body>

</html>
