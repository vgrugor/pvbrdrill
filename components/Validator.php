<?php

/**
 * Description of Validator2
 *
 * @author Zver
 */
class Validator {
    
    /**
     * Запуск валидации
     * @param mixed $value <p>значение для валидации</p>
     * @param array $params <p>массив с правилами валидации, первый элемент тип данных</p>
     * @return boolean <p>true - прошли валидацию, false - не прошли</p>
     */
    public function make($value, $params)
    {
        $methodName = array_shift($params);
        $methodName = 'validate' . $methodName;
        
        return $this->$methodName($value, ...$params);
    }
    
    /**
     * Валидация строковых значений
     * @param string $value <p>Строка для проверки</p>
     * @param integer $maxLen <p>максимально допустимая длинна</p>
     * @param integer $minLen <p>минимально допустимая длинна</p>
     * @return boolean <p>true - прошли валидацию, false - не прошли</p>
     */
    private function validateString($value, $minLen = 0, $maxLen = 0)
    {
        $lenString = mb_strlen($value);
        if ($lenString > $maxLen || $lenString < $minLen) {
            return false;
        }
        return true;
    }
    
    /**
     * Валидация числовых значений
     * @param integer|float $value <p>значение для проверки</p>
     * @param integer $maxVal <p>максимально допустимое значение</p>
     * @param integer $minVal <p>минимально допустимое значение</p>
     * @return boolean <p>true - прошли валидацию, false - не прошли</p>
     */
    private function validateNumeric($value, $minVal = 0, $maxVal = 0)
    {
        if (!is_numeric($value) && !$value == '') {
            return false;
        }
       
        if ($value > $maxVal && $value < $minVal) {
            return false;
        }
        return true;
    }
    
    /**
     * Проверка даты в формате ГГГГ-ММ-ДД
     * @param string $value <p>строка с датой для проверки</p>
     * @return boolean <p>true - прошли валидацию, false - не прошли</p>
     */
    private function validateDate($value)
    {
        $pattern = "~^[0-9]{4}-[0-9]{2}-[0-9]{2}$~";
        if (!preg_match($pattern, $value) && !$value == '') {
            return false;
        }
        return true;
    }
    
    /**
     * Валидация email пользователя
     * @param string $email <p>email пользователя</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    private function validateEmail($email) 
    {
        if (filter_var($email, FILTER_VALIDATE_EMAIL) || $email == '') {
            return true;
        }
        return false;
    }
    
    /**
     * Валидация мобильного телефона (ХХХ)ХХХ-ХХ-ХХ
     * @param string $phoneNumber <p>номер телефона</p>
     * @return boolean <p>true - прошло валидацию, false - не прошел</p>
     */
    private function validateMobileNumber($number)
    {
        $pattern = "~\([0-9]{3}\)[0-9]{3}-[0-9]{2}-[0-9]{2}~";
        if (preg_match($pattern, $number) || $number == '') {
            return true;
        }
        return false;
    }
}