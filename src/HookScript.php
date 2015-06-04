<?php

/**
 * This file is part of git-precommit-handler
 *
 * (c) SCTR Services 2015
 *
 * This source file is proprietary
 */

namespace Aequasi\PreCommitHandler;

use Composer\Script\Event;

/**
 * @author Aaron Scherer <aequasi@gmail.com>
 */
class HookScript
{
    public static function install(Event $event)
    {
        $gitDir     = realpath(__DIR__.'/../.git');
        $gitFile    = $gitDir.'/hooks/pre-commit';
        $scriptFile = __DIR__.'/../scripts/pre-commit';

        if (!file_exists($gitDir)) {
            $event->getIO()->writeError("This folder is not in a git repository.");
            return false;
        }

        $scriptHook = file_get_contents($scriptFile);
        if (!file_exists($gitFile) || $scriptHook !== file_get_contents($gitFile)) {
            copy($scriptFile, $gitFile);
        }

        return true;
    }
}
