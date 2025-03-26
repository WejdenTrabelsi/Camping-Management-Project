<form action="signup_process.php" method="POST">
    <input type="email" name="email" placeholder="Email" required>
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <select name="role">
        <option value="client">Client</option>
        <option value="admin">Admin</option>
    </select>
    <button type="submit">Sign Up</button>
</form>
