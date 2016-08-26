<?php
// My common functions
    function domain_exists($email, $record = 'MX'){
        list($user, $domain) = explode('@', $email);
        return checkdnsrr($domain, $record);
    }

    /**
     * Get the current release ID
     * This is useful for debugging, cache busting, and tagging deployments
     *
     * @param  boolean  [$full=false]
     * @return string
     */
    function release_id($full = false) {
        try {
            if (app()->environment('local')) {
                return uniqid();
            }
            $line = trim(file(base_path() . '/.release')[0]);
            return $full ? $line : substr($line, 0, 7);
        } catch (Exception $e) {
            return '';
        }
    }

?>
