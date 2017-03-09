<?php

class PrefixDocumentRoot
{
    /*
     * Преобразует префикс корня и возвращает в нужном виде
     * @var $str string - префикс
     * @var $param int - параметр преобразования
     *
     * Возможные варианты $param:
     * 1 - Возвращает строку для замены
     * 2 - Возвращает строку для контроллера
    */
    public function getPDRFromat($str = null, $param = 1)
    {
        if ($str == null)
        {
            return false;
        }
        $param = intval($param);
        if ($param < 1 && $param > 2)
        {
            return false;
        }
        $result = false;
        $pdr_segments = explode('\\', $str);
        if (count($pdr_segments) > 0)
        {
            // Удаляем пустые элементы массива
            $pdr_segments = array_diff($pdr_segments, array(''));
            // Сбрасываем ключи массива
            $pdr_segments = array_values($pdr_segments);
        }

        if ($param == 1)
        {
            // Формируем строку для замены ее в маршруте
            $result = implode($pdr_segments, '/');
            $result .= '/';
        }
        if ($param == 2)
        {
            // Формируем строку для замены ее в маршруте
            $result = '/'.implode($pdr_segments, '/');
        }

        return $result;
    }
}
