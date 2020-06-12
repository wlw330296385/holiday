<?php
// 应用公共文件

/**
 * @param $list
 * @param int $pid 第一层的key值
 * @param string $key
 * @return array
 * 递归, 只能实现两层;
 */
function tree ($list, int $pid = 0, $key = 'pid') {
    static $res = array();

    foreach ($list as $v) {
        $v['child'] = [];
        if ($v[$key] == $pid) {
            if ($pid == 0) {
                $res[] = $v;
            } else {
                foreach ($res as &$r) {
                    if ($v['pid'] == $r['id']) {
                        $r['child'][] = $v;
                    }
                }
            }
            tree($list, $v['id']);
        }
    }
    return $res;
}