<?php


function sortHostsByIPv4(array $data): array {
    if (!isset($data['hosts']) || !is_array($data['hosts'])) {
        return $data; // Return original if 'hosts' key is missing or not an array
    }
    
    // Extract hosts
    $hosts = $data['hosts'];
    
    // Sort hosts by 'host_ipv4'
    usort($hosts, function ($a, $b) {
        return ip2long($a['host_ipv4']) <=> ip2long($b['host_ipv4']);
    });
    
    // Reindex and return
    $data['hosts'] = array_values($hosts);
    return $data;
}



function getFileAgeInSeconds(string $filePath): int {
    if (!file_exists($filePath)) {
        return -1; // Return -1 if file does not exist
    }
    
    return time() - filemtime($filePath);
}