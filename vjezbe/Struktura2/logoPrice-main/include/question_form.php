<!-- form for creating new question and options -->
<div class="questionContainer">
    <div>
        <label for="question">Your question</label><br>
        <input type="text" name="question" id="question" placeholder="Question" value="<?php echo $errorMessage ? $_POST['question'] : ''; ?>">
    </div>
    <div class="calculator-option">
        <div class="edit-form__option">
            <h3>Option 1</h3>
            <div>
                <label for="name-1">Answer</label>
                <input type="text" name="1name" id="name-1" placeholder="Answer" value="<?php echo $errorMessage ? $_POST['1name'] : ''; ?>">
            </div>
            <div>
                <label for="price-1">Price</label>
                <input type="number" name="1price" id="price-1" placeholder="Price" value="<?php echo $errorMessage ? $_POST['1price'] : ''; ?>">
            </div>
            <div>
                <label for="url-1" class="file__label">Upload Image</label>
                <input type="file" name="1url" id="url-1">
                <img src="" alt="" class="option__image">
            </div>
        </div>
        <div class="edit-form__option">
            <h3>Option 2</h3>
            <div>
                <label for="name-2">Answer</label>
                <input type="text" name="2name" id="name-2" placeholder="Answer" value="<?php echo $errorMessage ? $_POST['2name'] : ''; ?>">
            </div>
            <div>
                <label for="price-2">Price</label>
                <input type="number" name="2price" id="price-2" placeholder="Price" value="<?php echo $errorMessage ? $_POST['2price'] : ''; ?>">
            </div>
            <div>
                <label for="url-2" class="file__label">Upload Image</label>
                <input type="file" name="2url" id="url-2">
                <img src="" alt="" class="option__image">
            </div>
        </div>
    </div>
    <button class="add-option special">Add option</button>
</div>
