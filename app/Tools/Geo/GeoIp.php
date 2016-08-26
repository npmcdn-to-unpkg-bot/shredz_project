<?php
/**
 * Used Maxmind Country CSV Database: http://dev.maxmind.com/geoip/geoip2/geolite2/
 * Used this sql to generate range fields:
 *   update maxmind_blocks_ipv4 set
 *   broadcast = (INET_ATON(substring_index(network_cidr, '/', 1)) + (pow(2, (32-substr(network_cidr, instr(network_cidr, '/')+1)))-1)),
 *   network = inet_aton(substring_index(network_cidr, '/', 1));
 * Tutorial here: http://davidkane.net/installing-new-geoip-database-sql-database/
 */
namespace App\Tools\Geo;

use Illuminate\Support\Facades\Log;

class GeoIp
{
    private $db_host;
    private $db_name;
    private $db_user;
    private $db_pass;
    private $db;
    private $detect_proxy = true;
    private $ip;
    private $ip_integer;

    public function __construct($ipAddress = NULL)
    {
        try {
            if ( ! $ipAddress) {
                $ipAddress = $this->getRemoteIp();
            }
            $this->ip = $ipAddress;
            $this->ip_integer = $this->dot2LongIP($ipAddress);
            $this->db_host = getenv('DB_HOST');
            $this->db_name = getenv('DB_DATABASE');
            $this->db_user = getenv('DB_USERNAME');
            $this->db_pass = getenv('DB_PASSWORD');
            $this->db = new \PDO('mysql:host='.$this->db_host.';dbname='.$this->db_name.';charset=utf8', $this->db_user, $this->db_pass);
        } catch (\Exception $e) {
        }
    }

    public function getContinentName()
    {
        return @$this->getData()['continent_name'] ?: false;
    }

    public function getCountryName()
    {
        return @$this->getData()['country_name'] ?: false;
    }

    public function getData()
    {
        try {
            if ($this->ip_integer) {
                $stmt = $this->db->prepare("SELECT *
                    FROM maxmind_legacy
                    WHERE from_ip_integer <= ? && to_ip_integer >= ?");
                $stmt->execute([$this->ip_integer, $this->ip_integer]);
                $result = $stmt->fetch(\PDO::FETCH_ASSOC);

                if ($result) {
                    return $result;
                }
            }
        } catch (\Exception $e) {
            //Log::error($e);
        }

        return false;
    }

    public function isContinentName($continentMatch)
    {
        $continent = $this->getContinentName();

        if ($continent && $continentMatch == $continent) {
            return true;
        }

        return false;
    }

    public function getContinentCode()
    {
        return @$this->getData()['continent_code'] ?: false;
    }

    public function getCountryCode()
    {
        return @$this->getData()['country_code'] ?: false;
    }

    public function isContinentCode($continentMatch)
    {
        $continent = $this->getContinentCode();

        if ($continent && $continentMatch == $continent) {
            return true;
        }

        return false;
    }

    public function dot2LongIP($ip)
    {
        try {
            if ($ip == "") {
                return 0;
            }
            $ips = explode(".", $ip);
            return ($ips[3] + $ips[2] * 256 + $ips[1] * 256 * 256 + $ips[0] * 256 * 256 * 256);
        } catch (\Exception $e) {
        }
        return 0;
    }

    public function getRemoteIp()
    {
        if ($this->detect_proxy && getenv('HTTP_X_FORWARDED_FOR')) {
            return getenv('HTTP_X_FORWARDED_FOR');
        }
        return getenv('REMOTE_ADDR');
    }

    public function getIp()
    {
        return $this->ip;
    }

    public function getIpInteger()
    {
        return $this->ip_integer;
    }
}
