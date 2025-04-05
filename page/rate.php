<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Star Rating CRUD</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            max-width: 1000px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f5f5f5;
        }

        .container {
            display: flex;
            gap: 20px;
        }

        .rating-form {
            flex: 1;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .ratings-list {
            flex: 2;
            background-color: white;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #333;
            margin-bottom: 25px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #555;
        }

        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        textarea {
            height: 100px;
            resize: vertical;
        }

        .stars {
            display: flex;
            margin: 20px 0;
        }

        .star {
            font-size: 30px;
            color: #ccc;
            cursor: pointer;
            transition: color 0.2s;
            margin-right: 5px;
        }

        .star:hover,
        .star.active {
            color: #ffcc00;
        }

        .btn {
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s;
            border: none;
        }

        .btn-submit {
            background-color: #4CAF50;
            color: white;
        }

        .btn-submit:hover {
            background-color: #45a049;
        }

        .btn-update {
            background-color: #2196F3;
            color: white;
            display: none;
        }

        .btn-update:hover {
            background-color: #0b7dda;
        }

        .btn-cancel {
            background-color: #f44336;
            color: white;
            display: none;
        }

        .btn-cancel:hover {
            background-color: #da190b;
        }

        .rating-item {
            border-bottom: 1px solid #eee;
            padding: 15px 0;
        }

        .rating-item:last-child {
            border-bottom: none;
        }

        .rating-item-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .rating-item-name {
            font-weight: bold;
            font-size: 18px;
        }

        .rating-item-stars {
            color: #ffcc00;
            font-size: 20px;
        }

        .rating-item-comment {
            margin: 10px 0;
        }

        .rating-item-date {
            color: #777;
            font-size: 14px;
        }

        .rating-item-actions {
            margin-top: 10px;
        }

        .btn-edit,
        .btn-delete {
            padding: 5px 10px;
            font-size: 14px;
            margin-right: 5px;
        }

        .btn-edit {
            background-color: #2196F3;
            color: white;
        }

        .btn-delete {
            background-color: #f44336;
            color: white;
        }

        .message {
            padding: 10px;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .success {
            background-color: #dff0d8;
            color: #3c763d;
        }

        .error {
            background-color: #f2dede;
            color: #a94442;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="rating-form">
            <h2 id="form-title">Add New Rating</h2>
            <div id="message" class="message" style="display: none;"></div>

            <form id="ratingForm">
                <input type="hidden" id="ratingId" value="">
                <div class="form-group">
                    <label for="name">Your Name</label>
                    <input type="text" id="name" placeholder="Enter your name" required>
                </div>

                <div class="form-group">
                    <label>Your Rating</label>
                    <div class="stars">
                        <span class="star" data-value="1">★</span>
                        <span class="star" data-value="2">★</span>
                        <span class="star" data-value="3">★</span>
                        <span class="star" data-value="4">★</span>
                        <span class="star" data-value="5">★</span>
                    </div>
                    <input type="hidden" id="rating" name="rating" value="0">
                </div>

                <div class="form-group">
                    <label for="comment">Your Comment</label>
                    <textarea id="comment" placeholder="Share your experience..." required></textarea>
                </div>

                <button type="submit" class="btn btn-submit" id="submitBtn">Submit Rating</button>
                <button type="button" class="btn btn-update" id="updateBtn">Update Rating</button>
                <button type="button" class="btn btn-cancel" id="cancelBtn">Cancel</button>
            </form>
        </div>

        <div class="ratings-list">
            <h2>Recent Ratings</h2>
            <div id="ratings-container">
                <!-- Ratings will be loaded here -->
                <?php include 'get_ratings.php'; ?>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star');
            const ratingInput = document.getElementById('rating');
            const form = document.getElementById('ratingForm');
            const submitBtn = document.getElementById('submitBtn');
            const updateBtn = document.getElementById('updateBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const formTitle = document.getElementById('form-title');
            const ratingIdInput = document.getElementById('ratingId');
            const messageDiv = document.getElementById('message');
            const ratingsContainer = document.getElementById('ratings-container');

            // Star rating functionality
            stars.forEach(star => {
                star.addEventListener('click', function() {
                    const value = parseInt(this.getAttribute('data-value'));
                    ratingInput.value = value;

                    stars.forEach(s => {
                        s.classList.remove('active');
                        if (parseInt(s.getAttribute('data-value')) <= value) {
                            s.classList.add('active');
                        }
                    });
                });
            });

            // Form submission for create
            form.addEventListener('submit', function(e) {
                e.preventDefault();

                if (ratingInput.value === '0') {
                    showMessage('Please select a rating', 'error');
                    return;
                }

                const formData = {
                    name: document.getElementById('name').value,
                    rating: ratingInput.value,
                    comment: document.getElementById('comment').value
                };

                fetch('create_rating.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Rating added successfully!', 'success');
                            resetForm();
                            loadRatings();
                        } else {
                            showMessage(data.message || 'Error adding rating', 'error');
                        }
                    })
                    .catch(error => {
                        showMessage('Network error. Please try again.', 'error');
                        console.error('Error:', error);
                    });
            });

            // Update button click
            updateBtn.addEventListener('click', function() {
                if (ratingInput.value === '0') {
                    showMessage('Please select a rating', 'error');
                    return;
                }

                const formData = {
                    id: ratingIdInput.value,
                    name: document.getElementById('name').value,
                    rating: ratingInput.value,
                    comment: document.getElementById('comment').value
                };

                fetch('update_rating.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(formData)
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Rating updated successfully!', 'success');
                            resetForm();
                            loadRatings();
                        } else {
                            showMessage(data.message || 'Error updating rating', 'error');
                        }
                    })
                    .catch(error => {
                        showMessage('Network error. Please try again.', 'error');
                        console.error('Error:', error);
                    });
            });

            // Cancel button click
            cancelBtn.addEventListener('click', resetForm);

            // Load ratings when page loads
            loadRatings();

            // Function to load ratings
            function loadRatings() {
                fetch('get_ratings.php')
                    .then(response => response.text())
                    .then(html => {
                        ratingsContainer.innerHTML = html;
                        // Add event listeners to edit and delete buttons
                        document.querySelectorAll('.btn-edit').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                editRating(id);
                            });
                        });
                        document.querySelectorAll('.btn-delete').forEach(btn => {
                            btn.addEventListener('click', function() {
                                const id = this.getAttribute('data-id');
                                if (confirm('Are you sure you want to delete this rating?')) {
                                    deleteRating(id);
                                }
                            });
                        });
                    });
            }

            // Function to edit rating
            function editRating(id) {
                fetch(`get_rating.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data) {
                            ratingIdInput.value = data.id;
                            document.getElementById('name').value = data.name;
                            document.getElementById('comment').value = data.comment;
                            ratingInput.value = data.rating;

                            // Update stars display
                            stars.forEach(star => {
                                star.classList.remove('active');
                                if (parseInt(star.getAttribute('data-value')) <= data.rating) {
                                    star.classList.add('active');
                                }
                            });

                            // Change form to edit mode
                            formTitle.textContent = 'Edit Rating';
                            submitBtn.style.display = 'none';
                            updateBtn.style.display = 'inline-block';
                            cancelBtn.style.display = 'inline-block';
                        }
                    });
            }

            // Function to delete rating
            function deleteRating(id) {
                fetch('delete_rating.php', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify({
                            id: id
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            showMessage('Rating deleted successfully!', 'success');
                            loadRatings();
                        } else {
                            showMessage(data.message || 'Error deleting rating', 'error');
                        }
                    });
            }

            // Function to reset form
            function resetForm() {
                form.reset();
                ratingIdInput.value = '';
                ratingInput.value = '0';
                stars.forEach(star => star.classList.remove('active'));
                formTitle.textContent = 'Add New Rating';
                submitBtn.style.display = 'inline-block';
                updateBtn.style.display = 'none';
                cancelBtn.style.display = 'none';
            }

            // Function to show messages
            function showMessage(message, type) {
                messageDiv.textContent = message;
                messageDiv.className = `message ${type}`;
                messageDiv.style.display = 'block';

                // Hide message after 5 seconds
                setTimeout(() => {
                    messageDiv.style.display = 'none';
                }, 5000);
            }
        });
    </script>
</body>

</html>