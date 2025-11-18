<?php
// gallery.php - display all uploaded images and videos
$uploadDir = __DIR__ . '/uploads';
$files = [];

// Collect all files
if (is_dir($uploadDir)) {
    $dir = scandir($uploadDir);
    foreach ($dir as $file) {
        if ($file === '.' || $file === '..') continue;
        $path = 'uploads/' . $file;
        $ext = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg','jpeg','png','gif','webp'])) {
            $files[] = ['type'=>'image','path'=>$path];
        } elseif (in_array($ext, ['mp4','webm','mov','avi'])) {
            $files[] = ['type'=>'video','path'=>$path];
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Uploaded Gallery</title>
<style>
body {
  font-family: system-ui, Arial;
  background: #f8f8f8;
  padding: 20px;
}
h1 {
  text-align: center;
  color: #333;
}
.gallery {
  display: grid;
  grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
  gap: 15px;
  margin-top: 20px;
}
.card {
  background: #fff;
  padding: 10px;
  border-radius: 10px;
  box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  text-align: center;
}
img, video {
  max-width: 100%;
  border-radius: 6px;
}
a {
  display: inline-block;
  margin-top: 5px;
  color: #007bff;
  text-decoration: none;
}
a:hover { text-decoration: underline; }
</style>
</head>
<body>

<h1> Uploaded Gallery</h1>
<p style="text-align:center;"><a href="index.html"> Back to Upload Page</a></p>

<div class="gallery">
<?php if (!empty($files)): ?>
  <?php foreach ($files as $f): ?>
    <div class="card">
      <?php if ($f['type'] === 'image'): ?>
        <img src="<?= htmlspecialchars($f['path']) ?>" alt="uploaded image">
      <?php elseif ($f['type'] === 'video'): ?>
        <video controls>
          <source src="<?= htmlspecialchars($f['path']) ?>">
        </video>
      <?php endif; ?>
      <a href="<?= htmlspecialchars($f['path']) ?>" target="_blank">Open File</a>
    </div>
  <?php endforeach; ?>
<?php else: ?>
  <p style="text-align:center;color:#555;">No uploads yet. <a href="index.html">Upload something!</a></p>
<?php endif; ?>
</div>

</body>
</html>

