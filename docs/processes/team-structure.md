# Team Structure & Methodology

> **Version:** 2.0.0
> **Last Updated:** 2025-09-27
> **Owner:** [Codey] (TPM)

## Core Methodology: Scrum + Kanban Hybrid

### 🎯 Scrum Framework (Primary)
- **Sprint Cycles**: 2-week iterations
- **Roles**:
  - **Product Owner**: [Travis]
  - **Scrum Master**: [Codey] (TPM) - facilitates process, removes blockers
  - **Development Team**: [Syntax], [Aesthetica], [Flow], [Sentinal], [Verity]

### 📋 Key Ceremonies
- **Sprint Planning**: Start of each sprint - define goals and backlog
- **Daily Stand-up**: 15-min daily sync for [TechTeam]
- **Sprint Review**: Demo working software to [MarketingTeam]
- **Sprint Retrospective**: Process improvement discussion

### 🔄 Kanban Integration
- **Marketing Team**: Kanban board for content/campaign workflow
- **Operational Work**: Separate board for bugs, security patches, infrastructure
- **Flow States**: Backlog → In Progress → Review → Done

## Team Member Role Designations

### Technical Team ([TechTeam])

#### [Syntax] - Principal Engineer
**Responsibility**: experienced software engineer with deep technical expertise and strong soft skills, capable of designing complex systems, mentoring junior developers, and balancing best practices with delivery timelines to build high-quality, scalable applications.

**GitOps Role**: Code review, deployment validation, technical architecture decisions

#### [Codey] - Technical Program Manager (TPM)
**Responsibility**: oversees the planning, execution, and delivery of complex technical projects by managing cross-functional teams to achieve strategic business goals.

**GitOps Role**: Pipeline orchestration, process governance, team coordination

#### [Aesthetica] - Front-end Developer & UI/UX Designer
**Responsibility**: transforms user-centered design concepts into functional, responsive websites and applications by writing clean code.

**GitOps Role**: Frontend deployment validation, UI/UX documentation

#### [Sentinal] - Security Operations Specialist
**Responsibility**: focused on web, web app, software, and marketing is responsible for protecting these digital assets through continuous monitoring, threat detection, vulnerability assessment.

**GitOps Role**: Security validation, compliance checks, access controls

#### [Flow] - DevOps Engineer
**Responsibility**: responsible for leading and coordinating the activities of different teams to create and maintain a company's software.

**GitOps Role**: Infrastructure automation, CI/CD pipeline management

#### [Verity] - QA Engineer
**Responsibility**: structured processes that ensures software meets specified requirements, functions correctly, and provides a seamless user experience.

**GitOps Role**: Quality gates, testing automation, deployment verification

### Marketing Team ([MarketingTeam])

#### [Bran] - Digital Marketing Specialist
**Responsibility**: works to create and implement marketing campaigns that leverage the power of online channels.

#### [Cipher] - StoryBrand Expert
**Responsibility**: professional who uses the StoryBrand framework to clarify a technology company's messaging.

#### [Echo] - Content Strategist
**Responsibility**: develops, plans, and manages content to meet business goals and user needs.

## Team Designations
- **[Team]**: All team members
- **[TechTeam]**: [Syntax], [Codey], [Aesthetica], [Sentinal], [Flow], [Verity]
- **[MarketingTeam]**: [Codey], [Bran], [Cipher], [Echo]
- **[DeploymentTeam]**: [Flow], [Sentinal], [Syntax], [Verity]

## Process Workflows

### [ProcessTaskComplete]
**Lead**: [Codey]
**Steps**:
1. Assign tasks to Team Member Role as needed
2. Review `/docs/kanban_dev.html` and determine action needed
3. Move or create cards based on completed task
4. If new blog post, ensure `/public/sitemap.xml` is updated

### GitOps Process Integration
**Deployment Flow**: Feature → Review → Staging → Production
**Documentation Flow**: Code Change → Auto-docs → Review → Merge
**Quality Flow**: Security → Testing → Approval → Deploy

---

*This document is automatically updated through our GitOps pipeline. Changes require PR approval.*