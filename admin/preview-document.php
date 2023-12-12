<?php
if (isset($_GET['document'])) {
    $encodedDocument = $_GET['document'];
    $decodedDocument = base64_decode($encodedDocument);

    // Output the decoded document content
    header("Content-type: application/msword");
    header("Content-disposition: inline; filename=preview-doc.doc");
    header("Content-length: " . strlen($decodedDocument));
    echo $decodedDocument;
    exit();
} else {
    echo "Document not found.";
}
?>
