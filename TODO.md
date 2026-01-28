<?php
                    $beneficiaries = $db_instance->getUserBeneficiaries($user['user_id']);
                    if (!empty($beneficiaries)):
                    ?>
                    <div class="card-section">
                        <h4>Beneficiaries</h4>
                        <?php foreach ($beneficiaries as $bene): ?>
                            <p><?php echo htmlspecialchars($bene['bene_fname'] . ' ' . $bene['bene_mname'] . ' ' . $bene['bene_lname'] . ($bene['bene_suffix'] ? ' ' . $bene['bene_suffix'] : '')); ?> (<?php echo htmlspecialchars($bene['bene_relationship']); ?>)</p>
                        <?php endforeach; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    $parents = $db_instance->getUserParents($user['user_id']);
                    if ($parents):
                    ?>
                    <div class="card-section">
                        <h4>Parents</h4>
                        <p><strong>Father:</strong> <?php echo htmlspecialchars($parents['father_fname'] . ' ' . $parents['father_mname'] . ' ' . $parents['father_lname'] . ($parents['fsuffix'] ? ' ' . $parents['fsuffix'] : '')); ?></p>
                        <p><strong>Mother:</strong> <?php echo htmlspecialchars($parents['mother_fname'] . ' ' . $parents['mother_mname'] . ' ' . $parents['mother_lname'] . ($parents['msuffix'] ? ' ' . $parents['msuffix'] : '')); ?></p>
                    </div>
                    <?php endif; ?>
                    
                    <?php
                    $employment = $db_instance->getUserEmployment($user['user_id']);
                    if ($employment):
                    ?>
                    <div class="card-section">
                        <h4>Employment</h4>
                        <p><strong>Type:</strong> <?php echo htmlspecialchars($employment['type']); ?></p>
                        <?php if ($employment['type'] == 'OFW'): ?>
                            <p><strong>Foreign Address:</strong> <?php echo htmlspecialchars($employment['foreign_address'] ?? ''); ?></p>
                        <?php elseif ($employment['type'] == 'Self-employed'): ?>
                            <p><strong>Profession/Business:</strong> <?php echo htmlspecialchars($employment['prof_business'] ?? ''); ?></p>
                            <p><strong>Year Started:</strong> <?php echo htmlspecialchars($employment['year_started'] ?? ''); ?></p>
                        <?php elseif ($employment['type'] == 'NWS'): ?>
                            <p><strong>Common Reference:</strong> <?php echo htmlspecialchars($employment['common_ref'] ?? ''); ?></p>
                        <?php endif; ?>
                        <p><strong>Monthly Earnings:</strong> <?php echo htmlspecialchars($employment['monthly_earnings'] ?? ''); ?></p>

                        


                    </div>
                    <?php endif; ?>