{extends file="base.tpl"}

{block name=title}Страница пользователя{/block}

{block name=content}

    <h1>Ваши регстрационные данные</h1>

    <form id="updateForm">
        <table>
            <tr>
                <td>Email</td>
                <td>{$user['email']}</td>
            </tr>
            <tr>
                <td>Имя</td>
                <td><input type="text" name="name" value="{$user['name']}"></td>
            </tr>
            <tr>
                <td>Телефон</td>
                <td><input type="text" name="phone" value="{$user['phone']}"></td>
            </tr>
            <tr>
                <td>Адрес</td>
                <td><textarea name="address" cols="30" rows="10">{$user['address']}</textarea></td>
            </tr>
            <tr>
                <td>Новый пароль</td>
                <td><input type="password" name="new_password"></td>
            </tr>
            <tr>
                <td>Повтор пароля</td>
                <td><input type="password" name="new_password_confirm"></td>
            </tr>
            <tr>
                <td>Веддите пароль для сохранения данных</td>
                <td><input type="password" name="current_password"></td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                <td><input type="submit" value="Сохранить"></td>
            </tr>
        </table>
    </form>

{/block}
