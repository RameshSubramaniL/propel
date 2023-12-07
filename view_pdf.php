<?php
include('db_connect.php');

session_start();

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['document_id'])) {
    $id = $conn1->real_escape_string($_GET['document_id']);
    $loginid = $conn1->real_escape_string($_GET['loginid']);
    $department_id = $conn1->real_escape_string($_GET['department_id']);

    $k1 = $conn1->query("SELECT * FROM file_details WHERE id = '$id'");
    
    if ($k1->num_rows > 0) {
        $rs1 = $k1->fetch_assoc();
        $filepath = $rs1['file_path'];
    } else {
        // Handle document not found, redirect or display an error message
        echo "Document not found.";
        exit;
    }

    $sql = $conn1->query("INSERT INTO view_log (file_details_autoid, employee_id, filename, department_id) VALUES ('$id', '$loginid', '$rs1[name]', '$department_id')");
} else {
    // Handle invalid request, redirect or display an error message
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Viewer</title>
    <!-- <link rel="stylesheet" href="viewer.css"> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.11.338/pdf.min.js"></script>
</head>

<body>
    <!-- PDF Viewer -->
    <!-- <div id="viewer"> -->

        <iframe id="viewer-iframe" src="<?php echo $filepath; ?>" width="100%" height="600px"></iframe>
    <!-- </div> -->
<iframe frameborder="0" scrolling="no" style="border:0px" src="https://books.google.com.kh/books?id=e5MkzETNcsgC&lpg=PP1&dq=typography&pg=PA11&output=embed" width="500" height=500>
</iframe>
    <script>
        window.onload = function () {
            // var viewer = document.getElementById('viewer');
            var iframe = document.getElementById('viewer-iframe');

            // Check if viewer and iframe exist
            if (iframe) {
                // Create a PDF.js instance
                var loadingTask = pdfjsLib.getDocument("<?php echo $filepath; ?>");

                // Load PDF document
                loadingTask.promise.then(function (pdfDocument) {
                    // Load PDF into the iframe
                    var pdfViewer = iframe.contentWindow.PDFViewerApplication;
                    pdfViewer.pdfDocument = pdfDocument;
                    pdfViewer.eventBus.dispatch("pagesloaded", {
                        source: pdfViewer,
                        pagesCount: pdfDocument.numPages,
                    });

                    // Get the instance from the PDFViewerApplication
                    var instance = pdfViewer.pdfViewer;

                    // Hide the toolbar items for printing and exporting PDF
                    const items = instance.toolbarItems;
                    instance.setToolbarItems(
                        items.filter((item) => item.type !== "print" && item.type !== "export-pdf")
                    );
                });
            }
        };
    </script>
</body>

</html>
