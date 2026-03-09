<?php
class IntTypeException extends Exception {}
class FloatTypeException extends Exception {}
class StringTypeException extends Exception {}
class BoolTypeException extends Exception {}
class ArrayTypeException extends Exception {}
class NullTypeException extends Exception {}
function calculate($variable) {
    if (is_int($variable)) {
        throw new IntTypeException();
    } elseif (is_float($variable)) {
        throw new FloatTypeException();
    } elseif (is_string($variable)) {
        throw new StringTypeException();
    } elseif (is_bool($variable)) {
        throw new BoolTypeException();
    } elseif (is_array($variable)) {
        throw new ArrayTypeException();
    } elseif (is_null($variable)) {
        throw new NullTypeException();
    }
}
$testValues = [
    42,  // int
    3.14,  // float
    "Hello",  // string
    true,   // bool
    [1, 2, 3],  // array
    null  // null
];
foreach ($testValues as $value) {
    try {
        calculate($value);
    } catch (IntTypeException $e) {
        echo "int — число\n";
    } catch (FloatTypeException $e) {
        echo "float — число\n";
    } catch (StringTypeException $e) {
        echo "string — строку\n";
    } catch (BoolTypeException $e) {
        echo "bool — булево значение\n";
    } catch (ArrayTypeException $e) {
        echo "array — массив\n";
    } catch (NullTypeException $e) {
        echo "null — объект\n";
    }
}

?>
