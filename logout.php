<?php
session_start();
session_destroy();
echo "<script>
        sessionStorage.removeItem('username');
        window.location.href = 'index.html';
      </script>";
?>
