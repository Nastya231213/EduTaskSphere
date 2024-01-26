<center>
    <h3>Create test question</h3>
</center>
<div class="card col-md-6 mt-4 mx-auto p-4">
    <form method="POST">
        <label for="question">
            <h5>Question:</h5>
        </label>
        <textarea name="questionTest" class="form-control p-3" rows="4" required></textarea>
        <label for="option1"><h5>Option 1:</h5></label>
        <input type="text" id="option1"class="form-control" name="option1" required>

        <label for="option2"><h5>Option 2:</h5></label>
        <input type="text" class="form-control" id="option2" name="option2" required>

        <label for="option3"><h5>Option 3:</h5></label>
        <input type="text" class="form-control" id="option3" name="option3" required>

        <label for="option4"><h5>Option 4:</h5></label>
        <input type="text"class="form-control" id="option4" name="option4" required>
        <label for="correctAnswer"><h5>Correct Answer (Option Number):</h5></label>
        <input type="number" id="correctAnswer" name="correctAnswer"class="form-control mb-2" required>
        <center><input type="submit" class="btn btn-primary" value="Add Question"></center>

    </form>
</div>
<br>