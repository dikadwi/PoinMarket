# Data Flow Diagram PoinMarket

## Context Diagram (Level 0)

Context Diagram menunjukkan interaksi sistem PoinMarket dengan entitas eksternal:

### External Entities:
1. **Mahasiswa**
   - Input: Login, profile updates, orders, bookings
   - Output: Account info, point balance, confirmations

2. **Dosen**
   - Input: Point awards, consultation schedule
   - Output: Student records, consultation requests

3. **Admin**
   - Input: Product management, order processing
   - Output: Reports, notifications, inventory status

4. **Superadmin**
   - Input: System configuration, user management
   - Output: System statistics, analytics, audit logs

## DFD Level 1

### Main Processes:

1. **User Authentication (1.0)**
   - Login/logout management
   - Session handling
   - Access control

2. **Point Management (2.0)**
   - Point awards from dosen
   - Point transactions
   - Balance updates
   - Transaction history

3. **Marketplace System (3.0)**
   - Product catalog
   - Shopping cart
   - Order processing
   - Inventory management

4. **Consultation System (4.0)**
   - Schedule management
   - Booking process
   - Consultation records
   - Feedback system

5. **User Management (5.0)**
   - User registration
   - Profile management
   - Role assignments
   - Access permissions

6. **Reporting & Analytics (6.0)**
   - Transaction reports
   - Point distribution analytics
   - System usage statistics
   - Performance monitoring

### Data Stores:

1. **D1 Users**
   - User profiles
   - Authentication data
   - Role information

2. **D2 Points**
   - Point balances
   - Transaction history
   - Point rules

3. **D3 Products**
   - Product catalog
   - Inventory levels
   - Product categories

4. **D4 Orders**
   - Order details
   - Transaction records
   - Payment information

5. **D5 Consultations**
   - Booking records
   - Schedule data
   - Consultation history

6. **D6 System Logs**
   - Activity logs
   - Error logs
   - Audit trails

### Data Flows:

1. **Authentication Flows**
   - Login credentials
   - Session tokens
   - Access permissions

2. **Point Management Flows**
   - Point awards
   - Balance updates
   - Transaction records

3. **Marketplace Flows**
   - Order placement
   - Stock verification
   - Payment processing

4. **Consultation Flows**
   - Schedule requests
   - Booking confirmations
   - Consultation records

5. **Management Flows**
   - User updates
   - System configuration
   - Role assignments

6. **Reporting Flows**
   - Data aggregation
   - Report generation
   - Analytics processing

## Security Considerations

1. **Data Protection**
   - Encrypted data transmission
   - Secure storage
   - Access controls

2. **Transaction Security**
   - Point verification
   - Balance validation
   - Transaction logging

3. **User Privacy**
   - Data anonymization
   - Access restrictions
   - Audit trails

## System Integration

1. **Database Integration**
   - Real-time updates
   - Data consistency
   - Backup procedures

2. **External Services**
   - Email notifications
   - Payment processing
   - Report generation

3. **User Interface**
   - Web interface
   - Mobile responsiveness
   - Real-time updates
