<?php
session_start();
include "../../config/db.php"; 

if (isset($_GET["request"])) {
    if (isset($_SESSION["username"])) {
        $user_id = $_SESSION["user_id"]; // Assuming user_id is stored in session
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>Requests</title>
    <!-- Other head elements -->
</head>
<body>
<div class="container mt-5">
    <!-- Add spacing between header and buttons -->
    <div class="mt-5 d-flex justify-content-center" style="margin-top: 50px;">
        <!-- Button to trigger Maintenance Request Modal -->
        <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#maintenanceRequestModal">
            Open Maintenance Request Form
        </button>

        <!-- Button to trigger Cash Advance Request Modal -->
        <button type="button" class="btn btn-primary mx-2" data-toggle="modal" data-target="#cashAdvanceRequestModal">
            Open Cash Advance Request Form
        </button>
    </div>

    <!-- Maintenance Request Modal -->
    <div class="modal fade" id="maintenanceRequestModal" tabindex="-1" aria-labelledby="maintenanceRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="maintenanceRequestModalLabel">Maintenance Request Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="function/function_crud.php" method="post">
                        <div class="mb-3">
                            <label for="item_name" class="form-label">Item Name:</label>
                            <input type="text" id="item_name" name="item_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="description" class="form-label">Team:</label>
                            <textarea id="description" name="description" class="form-control" required></textarea>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" name="maintenance_request" class="btn btn-primary">Submit Maintenance Request</button>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Cash Advance Request Modal -->
    <div class="modal fade" id="cashAdvanceRequestModal" tabindex="-1" aria-labelledby="cashAdvanceRequestModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cashAdvanceRequestModalLabel">Cash Advance Request Form</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="function/function_crud.php" method="post">
                        <div class="mb-3">
                            <label for="employee_name" class="form-label">Employee Name:</label>
                            <input type="text" id="employee_name" name="employee_name" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="amount" class="form-label">Amount:</label>
                            <input type="number" step="0.01" id="amount" name="amount" class="form-control" required>
                        </div>
                        <div class="modal-footer">
                        <button type="submit" name="cash_advance" class="btn btn-primary">Submit Cash Advance Request</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Data Grid Views -->
    <div class="mt-5">
        <!-- Maintenance Requests Data Grid View -->
        <h2>Maintenance Requests</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Item Name</th>
                    <th>Team</th>
                    <th>Request Date</th>
                    <th>Admin Comment</th>
                    <th>Admin Approval</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch maintenance requests for the logged-in user
                $sql = "SELECT * FROM maintenance_requests WHERE user_id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["item_name"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["description"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["request_date"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["admin_comment"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["admin_approval"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <div class="mt-5">
        <!-- Cash Advances Data Grid View -->
        <h2>Cash Advances</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Amount</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch cash advances for the logged-in user
                $sql = "SELECT * FROM cash_advances WHERE user_id = ?";
                $stmt = $con->prepare($sql);
                $stmt->bind_param("i", $user_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . htmlspecialchars($row["id"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["name"]) . "</td>";
                        echo "<td>₱" . htmlspecialchars($row["amount"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                        echo "<td>" . htmlspecialchars($row["status"]) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No records found</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        <?php if (isset($_SESSION["notify"])) { ?>
            <?php if ($_SESSION["notify"] == "success-add") { ?>
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    text: 'Your request has been submitted successfully!'
                });
            <?php } elseif ($_SESSION["notify"] == "failed-add") { ?>
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'There was an error submitting your request. Please try again.'
                });
            <?php } ?>
            <?php unset($_SESSION["notify"]); ?>
        <?php } ?>
    });
</script>
<script>
    // Maintenance Request Form Validation
    document.querySelector('form[action="function/function_crud.php"]').addEventListener('submit', function(e) {
        const itemName = document.getElementById('item_name').value.trim();
        const description = document.getElementById('description').value.trim();

        if (itemName === "" || itemName.length > 50) {
            e.preventDefault();
            alert("Please provide a valid item name (max length 50 characters).");
        }

        if (description === "" || description.length > 150) {
            e.preventDefault();
            alert("Please provide a valid description (max length 150 characters).");
        }
    });

    // Cash Advance Request Form Validation
    document.querySelector('form[action="function/function_crud.php"]').addEventListener('submit', function(e) {
        const employeeName = document.getElementById('employee_name').value.trim();
        const amount = parseFloat(document.getElementById('amount').value);

        if (employeeName === "" || employeeName.length > 40) {
            e.preventDefault();
            alert("Please provide a valid employee name (max length 40 characters).");
        }

        if (isNaN(amount) || amount <= 0) {
            e.preventDefault();
            alert("Please provide a valid amount greater than 0.");
        }
    });
</script>
</body>
</html>

<?php
        $con->close();
    }
}
?>
