<?php
/**
 * Quick template check script
 * Run this file directly to check which templates are available
 *
 * @package WPCore
 */

// Load WordPress
require_once('../../../wp-load.php');

// Check if user is admin
if (!current_user_can('manage_options')) {
    die('Access denied. Admin only.');
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>WPCore Template Check</title>
    <style>
        body { font-family: Arial, sans-serif; padding: 20px; background: #f5f5f5; }
        .container { max-width: 1200px; margin: 0 auto; background: white; padding: 20px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #333; border-bottom: 2px solid #3b82f6; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; }
        th { background: #3b82f6; color: white; }
        tr:hover { background: #f9f9f9; }
        .block { color: #10b981; font-weight: bold; }
        .php { color: #f59e0b; font-weight: bold; }
        .both { color: #6366f1; font-weight: bold; }
        .none { color: #ef4444; font-weight: bold; }
        .info { background: #e0f2fe; padding: 15px; border-radius: 4px; margin-top: 20px; }
        .current { background: #fef3c7; }
    </style>
</head>
<body>
    <div class="container">
        <h1>🔍 WPCore Template Check</h1>
        
        <?php
        // Get current template info
        $current_info = wpcore_get_current_template_info();
        ?>
        
        <div class="info">
            <strong>Current Template:</strong> 
            <span class="<?php echo esc_attr($current_info['template_type']); ?>">
                <?php echo esc_html(strtoupper($current_info['template_type'])); ?>
            </span>
            <br>
            <strong>File:</strong> <?php echo esc_html($current_info['template_file']); ?>
            <br>
            <strong>Path:</strong> <?php echo esc_html($current_info['template_path']); ?>
        </div>
        
        <h2>Template Availability</h2>
        <table>
            <thead>
                <tr>
                    <th>Template Name</th>
                    <th>Block Template</th>
                    <th>PHP Template</th>
                    <th>Status</th>
                    <th>Will Use</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $templates = array('index', 'single', 'page', 'home', 'archive', 'search', '404', 'front-page');
                
                foreach ($templates as $template_name) {
                    $block_exists = wpcore_block_template_exists($template_name);
                    $php_exists = wpcore_php_template_exists($template_name);
                    $template_type = wpcore_get_template_type($template_name);
                    
                    $status = 'none';
                    if ($block_exists && $php_exists) {
                        $status = 'both';
                    } elseif ($block_exists) {
                        $status = 'block';
                    } elseif ($php_exists) {
                        $status = 'php';
                    }
                    
                    $is_current = ($current_info['template_file'] === $template_name . '.html' || 
                                  $current_info['template_file'] === $template_name . '.php');
                    
                    echo '<tr' . ($is_current ? ' class="current"' : '') . '>';
                    echo '<td><strong>' . esc_html($template_name) . '</strong></td>';
                    echo '<td>' . ($block_exists ? '✅ <span class="block">EXISTS</span>' : '❌ Not found') . '</td>';
                    echo '<td>' . ($php_exists ? '✅ <span class="php">EXISTS</span>' : '❌ Not found') . '</td>';
                    echo '<td><span class="' . esc_attr($status) . '">' . strtoupper($status) . '</span></td>';
                    echo '<td><span class="' . esc_attr($template_type) . '">' . strtoupper($template_type) . '</span></td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
        
        <div class="info" style="margin-top: 30px;">
            <h3>📝 Notes:</h3>
            <ul>
                <li><strong>WordPress Priority:</strong> Block templates are prioritized over PHP templates</li>
                <li><strong>If both exist:</strong> WordPress will use the block template</li>
                <li><strong>If only one exists:</strong> WordPress will use that template</li>
                <li><strong>If none exists:</strong> WordPress will use the default template hierarchy</li>
            </ul>
        </div>
        
        <div class="info" style="margin-top: 20px;">
            <h3>🎯 For Index Template:</h3>
            <?php
            $index_block = wpcore_block_template_exists('index');
            $index_php = wpcore_php_template_exists('index');
            $index_type = wpcore_get_template_type('index');
            ?>
            <p>
                <strong>Block Template:</strong> 
                <?php echo $index_block ? '✅ <span class="block">EXISTS</span> (' . esc_html(basename($index_block)) . ')' : '❌ Not found'; ?>
            </p>
            <p>
                <strong>PHP Template:</strong> 
                <?php echo $index_php ? '✅ <span class="php">EXISTS</span> (' . esc_html(basename($index_php)) . ')' : '❌ Not found'; ?>
            </p>
            <p>
                <strong>WordPress will use:</strong> 
                <span class="<?php echo esc_attr($index_type); ?>"><?php echo strtoupper($index_type); ?> TEMPLATE</span>
            </p>
        </div>
    </div>
</body>
</html>

