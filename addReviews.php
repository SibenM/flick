<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form action="">
        <label for="movies">Choose a movie:</label>

        <select name="movies" id="movies">
            <option value="avatar">Avatar</option>
            <option value="sinners">Sinners</option>
            <option value="sausage-party">Sausage Party</option>
            <option value="tnp">The Nutty Professor</option>
        </select>

        <label for="ratings">Rate from 1-5:</label>
        <select name="ratings" id="ratings">
            <option value="1">1</option>
            <option value="2">2</option>
            <option value="3">3</option>
            <option value="4">4</option>
            <option value="5">5</option>
        </select>

        <label for="review">Write a short review:</label>
        <textarea name="review" id="review" rows="4" cols="50"></textarea>
        <input type="submit" value="Submit">
    </form>
</body>
</html>