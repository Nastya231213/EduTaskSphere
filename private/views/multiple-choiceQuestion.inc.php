<center>
    <h3>Create open-ended question</h3>
</center>
<div class="card col-md-6 mt-4 mx-auto p-4">
    <form method="POST">
        <label for="question">
            <h5>Question:</h5>
        </label>
        <textarea name="questionMultichoice" class="form-control p-3 mb-2" rows="4" required></textarea>
  
        <label for="choice1"><h5>Choice 1:</h5></label>
        <input type="text" class="form-control" id="choice1" name="choices[]" required><br>

        <label for="choice2"><h5>Choice 2:</h5></label>
        <input type="text" class="form-control"id="choice2" name="choices[]" required><br>

        <label for="choice3"><h5>Choice 3:</h5></label>
        <input type="text" id="choice3"class="form-control" name="choices[]" required><br>
        <label for="choice4"><h5>Choice 4:</h5></label>
        <input type="text" id="choice4" class="form-control" name="choices[]" required><br>
        <!-- Add more choices as needed -->

        <!-- Correct Answers (Checkboxes) -->
        <label><h5>Correct Answers:</h5></label><br>
        <input type="checkbox" id="correctAnswer1" name="correctAnswers[]" value="1">
        <label for="correctAnswer1">Choice 1</label><br>

        <input type="checkbox" id="correctAnswer2" name="correctAnswers[]" value="2">
        <label for="correctAnswer2">Choice 2</label><br>

        <input type="checkbox" id="correctAnswer3" name="correctAnswers[]" value="3">
        <label for="correctAnswer3">Choice 3</label><br>
        
        <input type="checkbox" id="correctAnswer4" name="correctAnswers[]" value="4">
        <label for="correntAnswer4">Choice 4</label>

        <center><input type="submit" class="btn btn-primary " value="Create Question"></center>

    </form>
</div><br>s