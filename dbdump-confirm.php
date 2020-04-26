<?php
session_start();
include 'connection.php';

$stmt = $con->prepare('SELECT * FROM users ');
$stmt->execute();
$users = $stmt->fetchAll(PDO::FETCH_ASSOC);


$stmt2 = $con->prepare('SELECT * FROM `messages`');
$stmt2->execute();
$messages = $stmt2->fetchAll(PDO::FETCH_ASSOC);

$stmt3 = $con->prepare('SELECT * FROM `question`');
$stmt3->execute();
$questions = $stmt3->fetchAll(PDO::FETCH_ASSOC);


$stmt4 = $con->prepare('SELECT * FROM `questionanswer`');
$stmt4->execute();
$questionanswers = $stmt4->fetchAll(PDO::FETCH_ASSOC);
?>

<h2>All Users</h2>
<table border='1'>
	<tr>
		<th>username</th>
		<th>password</th>
	</tr>
	<?php foreach ($users as $user) { ?>
		<tr>
			<td><?php echo $user['username'] ?></td>
			<td><?php echo $user['password'] ?></td>
		</tr>
	<?php } ?>
	
</table>


<h2>All Messages</h2>
<table border='1'>
	<tr>
		<th>ID</th>
		<th>From User</th>
		<th>To User</th>
		<th>Content</th>
		<th>Date</th>
	</tr>
	<?php foreach ($messages as $message) { ?>
		<tr>
			<th><?php echo $message['id'] ?></th>
			<th><?php echo $message['fromUser'] ?></th>
			<th><?php echo $message['toUser'] ?></th>
			<th><?php echo $message['content'] ?></th>
			<th><?php echo $message['date'] ?></th>
		</tr>
	<?php } ?>
	
</table>


<h2>All Questions</h2>
<table border='1'>
	<tr>
		<th>ID</th>
		<th>Text</th>
	</tr>
	<?php foreach ($questions as $question) { ?>
		<tr>
			<th><?php echo $question['id'] ?></th>
			<th><?php echo $question['text'] ?>
		</tr>
	<?php } ?>
	
</table>



<h2>All Questions Answers</h2>
<table border='1'>
	<tr>
		<th>Username</th>
		<th>Question ID</th>
		<th>Answer</th>
	</tr>
	<?php foreach ($questionanswers as $questionanswer) { ?>
		<tr>
			<th><?php echo $questionanswer['username'] ?></th>
			<th><?php echo $questionanswer['questionID'] ?></th>
			<th><?php echo $questionanswer['answer'] ?></th>
		</tr>
	<?php } ?>
	
</table>
