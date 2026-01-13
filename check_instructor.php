<?php
/**
 * Diagnostic script to check instructor setup
 * Run this from command line: php check_instructor.php
 */

require __DIR__.'/vendor/autoload.php';

$app = require_once __DIR__.'/bootstrap/app.php';
$app->make('Illuminate\Contracts\Console\Kernel')->bootstrap();

use App\Models\User;
use App\Models\Instructor;
use App\Models\Organization;

echo "=== Instructor Setup Diagnostic ===\n\n";

// Check for users with instructor role
$instructorUsers = User::where('role_id', 2)->get();

if ($instructorUsers->isEmpty()) {
    echo "❌ No users found with role_id = 2 (instructor role)\n";
    echo "   You need to create a user with role_id = 2 first.\n\n";
} else {
    echo "✓ Found " . $instructorUsers->count() . " user(s) with instructor role:\n\n";
    
    foreach ($instructorUsers as $user) {
        echo "User ID: {$user->id}\n";
        echo "Name: {$user->name}\n";
        echo "Email: {$user->email}\n";
        
        // Check if instructor record exists
        $instructor = Instructor::where('user_id', $user->id)->first();
        
        if (!$instructor) {
            echo "❌ MISSING: No instructor record found for this user\n";
            echo "   You need to create an instructor record:\n";
            echo "   INSERT INTO instructors (user_id, organization_id, slug, created_at, updated_at) VALUES ({$user->id}, 1, 'instructor-{$user->id}', NOW(), NOW());\n\n";
        } else {
            echo "✓ Instructor record exists (ID: {$instructor->id})\n";
            
            // Check organization
            if (!$instructor->organization_id) {
                echo "❌ MISSING: Instructor has no organization_id\n";
                echo "   You need to set organization_id:\n";
                echo "   UPDATE instructors SET organization_id = 1 WHERE id = {$instructor->id};\n\n";
            } else {
                echo "✓ Organization ID: {$instructor->organization_id}\n";
                
                // Check if organization exists
                $org = Organization::find($instructor->organization_id);
                if (!$org) {
                    echo "❌ WARNING: Organization ID {$instructor->organization_id} does not exist\n";
                } else {
                    echo "✓ Organization exists: {$org->name}\n";
                }
            }
        }
        echo str_repeat("-", 50) . "\n\n";
    }
}

echo "\n=== Summary ===\n";
echo "To fix the 'instructor not found' error:\n";
echo "1. Ensure user has role_id = 2\n";
echo "2. Create an instructor record linked to the user\n";
echo "3. Set organization_id in the instructor record\n";
echo "4. Ensure the organization exists\n\n";
