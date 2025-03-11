#!/bin/bash

# Define MySQL credentials
USER="neb"
PASSWORD="password"
DATABASE="nebero"

# Execute the SQL commands
mysql -u $USER -p$PASSWORD $DATABASE <<EOF
-- Start a transaction to ensure data consistency
START TRANSACTION;

-- Delete related rows from domain_category_via_llama
DELETE FROM domain_category_via_llama 
WHERE domain_name IN (
    SELECT domain_name FROM domain_info WHERE count > 0
);

-- Delete related rows from history_table
DELETE FROM history_table 
WHERE domain_id IN (
    SELECT domain_name FROM domain_info WHERE count > 0
);

-- Finally, delete from domain_info
DELETE FROM domain_info WHERE count > 0;

-- Commit the transaction
COMMIT;
EOF

# Check if the MySQL command was successful
if [ $? -eq 0 ]; then
    echo "Transaction executed successfully."
else
    echo "Failed to execute transaction."
fi

clear
