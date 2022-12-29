{if isset($user)}

    <div id="userBox">
        <a href="/user/" id="userLink" class="username">{$user['username']}</a>
        <br />
        <form action="/user/logout/" method="POST">
            <input type="submit" value="Выход">
        </form>
    </div>

{else}

    <div id="userBox" class="hide-me">
        <a href="#" id="userLink" class="username"></a>
        <br />
        <form action="/user/logout/" method="POST">
            <input type="submit" value="Выход">
        </form>
    </div>

    <div id="loginBox" class="login-box">
        <div class="menu-caption">Авторизация</div>
        <form id="loginForm">
            <div>
                <label for="loginEmail">email</label>
                <div>
                    <input id="loginEmail" name="login_email" type="email">
                </div>
            </div>
            <div>
                <label for="loginPassword">пароль</label>
                <div>
                    <input id="loginPassword" name="login_password" type="password">
                </div>
            </div>
            <div>
                <input type="submit" value="Войти">
            </div>
        </form>
    </div>

    <div id="registerBox" class="register-box">
        <div class="menu-caption">Регистрация</div>
        <form id="registerForm" class="hide-me">
            <div>
                <label for="email">email</label>
                <div>
                    <input id="email" name="email" type="email">
                </div>
            </div>
            <div>
                <label for="password">пароль</label>
                <div>
                    <input id="password" name="password" type="password">
                </div>
            </div>
            <div>
                <label for="password_confirm">подтвердите пароль</label>
                <div>
                    <input id="password_confirm" name="password_confirm" type="password">
                </div>
            </div>
            <div>
                <input type="submit" value="Зарегестрироваться">
            </div>
        </form>
    </div>

{/if}
