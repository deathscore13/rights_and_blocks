<?php

if ($m->cmd('rights'))
{
    if ($m->param(1, ['set', LANG_RIGHTS_AND_BLOCKS[19]]))
    {
        $chat = $m->param(4);

        if (!$vk->isAdmin($vk->obj['from_id']))
        {
            if ($chat === false || $chat === $rights->getChat())
            {
                if (!$rights->isRight($vk->obj['from_id'], 'root'))
                    $m->error(LANG_RIGHTS_AND_BLOCKS[0]);
            }
            else if (!$rights->isRight($vk->obj['from_id'], 'root', $chat))
            {
                $m->error(LANG_RIGHTS_AND_BLOCKS[22], $chat);
            }
        }

        if (($right = $m->param(2)) === false)
            $m->error(LANG_ENGINE[11], 2);
        
        if (!$m->param(3, [0, 1]))
            $m->error(LANG_RIGHTS_AND_BLOCKS[1]);
        
        if (($target = $m->target(1)) === false)
            $m->error(LANG_ENGINE[7], 1);
        
        if (!$rights->setRight($target, $right, $m->param(3), $chat === false ? '' : $chat))
            $m->error(LANG_RIGHTS_AND_BLOCKS[2]);

        $vk->send(LANG_RIGHTS_AND_BLOCKS[3]);
    }
    else if ($m->param(1, ['info', LANG_RIGHTS_AND_BLOCKS[20]]))
    {
        if (($target = $m->target(1)) === false)
            $m->error(LANG_ENGINE[7], 1);
        
        $send = '';
        if ($vk->isAdmin($target))
            $send = PHP_EOL.LANG_RIGHTS_AND_BLOCKS[4].PHP_EOL;

        foreach ($db->query('SELECT * FROM '.Rights::TABLE.' WHERE id LIKE \''.$target.'_%\'', PDO::FETCH_ASSOC) as $row)
        {
            $send .= PHP_EOL.substr($row['id'], strpos($row['id'], '_') + 1).': ';
            $i = 0;
            $res = array_keys($row);
            while (isset($res[++$i]))
            {
                if ($row[$res[$i]])
                {
                    if (is_numeric($buffer = substr($res[$i], 1)))
                        $res[$i] = $buffer + 2000000000;
                    $send .= $res[$i].', ';
                }
            }
            $send = substr($send, 0, -2);
        }

        if (!$send)
            $send = PHP_EOL.LANG_RIGHTS_AND_BLOCKS[5];
        
        $vk->send(LANG_RIGHTS_AND_BLOCKS[6].PHP_EOL.$send);
    }
    else if ($m->param(1, ['list', LANG_RIGHTS_AND_BLOCKS[21]]))
    {
        $send = LANG_RIGHTS_AND_BLOCKS[9].PHP_EOL;
        foreach ($rights->getRights() as $right => $description)
            $send .= PHP_EOL.$right.' - '.($description ? $description : '???');
        $vk->send($send);
    }
    else
    {
        $vk->send(LANG_ENGINE[3].$m->aboutCmd('rights'));
    }

    exit();
}
else if ($m->cmd('blocks'))
{
    if ($m->param(1, ['set', LANG_RIGHTS_AND_BLOCKS[19]]))
    {
        $chat = $m->param(4);

        if (!$vk->isAdmin($vk->obj['from_id']))
        {
            if ($chat === false || $chat === $rights->getChat())
            {
                if (!$rights->isRight($vk->obj['from_id'], 'blocks'))
                    $m->error(LANG_RIGHTS_AND_BLOCKS[10], 'blocks');
            }
            else if (!$rights->isRight($vk->obj['from_id'], 'blocks', $chat))
            {
                $m->error(LANG_RIGHTS_AND_BLOCKS[30], $chat);
            }
        }

        if (($block = $m->param(2)) === false)
            $m->error(LANG_ENGINE[11], 2);
        
        if (!$m->param(3, [0, 1]))
            $m->error(LANG_RIGHTS_AND_BLOCKS[1]);
        
        if (($target = $m->target(1)) === false)
            $m->error(LANG_ENGINE[7], 1);
        
        if (!$blocks->setBlock($target, $block, $m->param(3), $chat === false ? '' : $chat))
            $m->error(LANG_RIGHTS_AND_BLOCKS[31]);

        $vk->send(LANG_RIGHTS_AND_BLOCKS[32]);
    }
    else if ($m->param(1, ['info', LANG_RIGHTS_AND_BLOCKS[20]]))
    {
        if (($target = $m->target(1)) === false)
            $m->error(LANG_ENGINE[7], 1);
        
        $send = '';
        foreach ($db->query('SELECT * FROM '.Blocks::TABLE.' WHERE id LIKE \''.$target.'_%\'', PDO::FETCH_ASSOC) as $row)
        {
            $send .= PHP_EOL.substr($row['id'], strpos($row['id'], '_') + 1).': ';
            $i = 0;
            $res = array_keys($row);
            while (isset($res[++$i]))
            {
                if ($row[$res[$i]])
                {
                    if (is_numeric($buffer = substr($res[$i], 1)))
                        $res[$i] = $buffer + 2000000000;
                    
                    $send .= $res[$i].', ';
                }
            }
            $send = substr($send, 0, -2);
        }

        if (!$send)
            $send = PHP_EOL.LANG_RIGHTS_AND_BLOCKS[33];
        
        $vk->send(LANG_RIGHTS_AND_BLOCKS[34].PHP_EOL.$send);
    }
    else if ($m->param(1, ['list', LANG_RIGHTS_AND_BLOCKS[21]]))
    {
        $send = LANG_RIGHTS_AND_BLOCKS[35].PHP_EOL;
        foreach ($blocks->getBlocks() as $block => $description)
            $send .= PHP_EOL.$block.' - '.($description ? $description : '???');
        
        $vk->send($send);
    }
    else
    {
        $vk->send(LANG_ENGINE[3].$m->aboutCmd('blocks'));
    }
    
    exit();
}
