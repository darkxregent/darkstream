<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fileName = $_POST['fileName'];
    $filePath = '../media/ds_couvers/' . $fileName;

    if (file_exists($filePath)) {
        if (unlink($filePath)) {
            echo json_encode(['status' => 'success', 'message' => 'File deleted successfully.']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Failed to delete the file.']);
        }
    } else {
        echo json_encode(['status' => 'error', 'message' => 'File does not exist.']);
    }
}
?>