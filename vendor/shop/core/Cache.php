<?php


namespace shop;


class Cache extends Singleton
{
    /**
     * закэшировать
     * @param string $key
     * @param $data
     * @param int $seconds
     * @return bool
     */
    public function set(string $key, $data, int $seconds = 3600): bool
    {
        if ($seconds) {
            $content['data'] = $data;
            $content['end_time'] = time() + $seconds;
            if (file_put_contents(CACHE . '/' . md5($key) . '.txt', serialize($content))) {
                return true;
            }
        }
        return false;
    }

    /**
     * получить кэш
     * @param string $key
     * @return false|mixed
     */
    public function get(string $key)
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            $content = unserialize(file_get_contents($file));
            if (time() <= $content['end_time']) {
                return $content;
            }
            unlink($file);
        }
        return false;
    }

    /**
     * удалить кэш
     * @param string $key
     */
    public function delete(string $key): void
    {
        $file = CACHE . '/' . md5($key) . '.txt';
        if (file_exists($file)) {
            unlink($file);
        }
    }
}
