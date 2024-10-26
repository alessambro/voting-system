<?php
if (isset($conn) && $conn) {
    mysqli_close($conn);
}
