<?php
/**
 * @throws Exception
 */
function validation(string $formName, array $formData, bool $checkFieldExist = true): void {
    if (!isset(VALIDATION_RULES[$formName])) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }
    $formRules = VALIDATION_RULES[$formName];
    if ($checkFieldExist && count($formData) !== count($formRules)) {
        throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
    }
    $statusMessage = [];
    foreach (VALIDATION_RULES[$formName] as $fieldName => $fieldValue) {
        if ($checkFieldExist && !isset($formData[$fieldName])) {
            throw new Exception("НЕИЗВЕСТНАЯ ФОРМА");
        }
        if (isset($fieldValue["required"]) && $fieldValue["required"] && !$formData[$fieldName]){
            $statusMessage[] = "Поле $fieldName не заполнено";
        }
        if (
            @$fieldValue["pattern"]
            && @$formData[$fieldName]
            && !preg_match($fieldValue["pattern"], $formData[$fieldName])
        ) {
            $statusMessage[] = "Поле $fieldName не корректно заполнено";
        }
    }
    if (!empty($statusMessage)) {
        throw new Exception(implode("<br>", $statusMessage));
    }
}

/**
 * @throws Exception
 */
function checkAge(string $birthday): void {
    if ((time() - SECONDS_OF_YEAR * MIN_USER_AGE) < strtotime($birthday)) {
        throw new Exception("К сожалению, Вы слишком молоды");
    }
    elseif ((time() - SECONDS_OF_YEAR * MAX_USER_AGE) > strtotime($birthday)) {
        throw new Exception("К сожалению, Вы слишком старый");
    }
}