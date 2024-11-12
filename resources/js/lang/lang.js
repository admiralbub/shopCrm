function Lang() {

    const htmlElement = document.documentElement;

    // Получаем значение атрибута lang
    const langValue = htmlElement.getAttribute('lang');
    // Инициализируем глобальный объект lang, если он еще не существует
    window.lang = window.lang || {};
    
    // Убедимся, что lang является объектом для хранения валидаторов
    if (!window.lang.validator) {
        window.lang.validator = {};
    }

    // Добавляем валидаторы в зависимости от языка
    switch (langValue) {
        case 'ua':
            window.lang.validator.empty = 'Це поле порожнє';
            window.lang.validator.error = 'Помилка';
            window.lang.validator.error_valid = 'Ви заповнили не коректно поля у формі';
            window.lang.validator.email = "Невірний формат Email";
            window.lang.validator.phone = "Невірний формат номера телефона";
            window.lang.validator.maxlength = "Дуже багато символів";
            window.lang.validator.minlength = "Дуже мало символів";
            window.lang.validator.confirm_pass = "Не збігається пароль із підтвердженням.";
            window.lang.validator.emptyBasket = "Ваш кошик порожній";
            window.lang.validator.select_required = "Ви не обрали значення у списку, що випадає";
            break;
        case 'ru':
            window.lang.validator.empty = 'Данное поле пустое';
            window.lang.validator.error = 'Ошибка';
            window.lang.validator.error_valid = 'Вы заполнили не корректно поля в форме';
            window.lang.validator.email = "Неправильный формат Email";
            window.lang.validator.phone = "Неправильный формат номера телефона";
            window.lang.validator.maxlength = "Очень много символов";
            window.lang.validator.minlength = "Очень мало символов";
            window.lang.validator.confirm_pass = "Не совпадает пароль с подтверждением."
            window.lang.validator.emptyBasket = "Ваша корзина пуста";
            window.lang.validator.select_required = "Вы не выбрали значения в выпадающем списке";
            break;
        // Вы можете добавить дополнительные языки здесь
    }  
}

export default Lang;